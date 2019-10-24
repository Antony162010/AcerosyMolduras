<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class AdminRepository
{

    public function signin($request)
    {
        try {
            $userEmail = trim($request->input('userEmail'));
            $userPassword = trim($request->input('userPassword'));

            $response = DB::select('call sp_signin_admin(?,?)', [
                $userEmail,
                $userPassword,
            ]);

            // dd($response);
            if (sizeof($response) > 0) {
                if ($response[0]->ESTADO == 1) {
                    $_SESSION['user_session'] = array(
                        "id" => $response[0]->CLAVE,
                        "user_name" => $response[0]->NOMBRE_USUARIO,
                        "user_lastname" => $response[0]->APELLIDO,
                        "user_email" => $response[0]->CORREO_USUARIO,
                    );
                    return \redirect()->route('home')->with(['user' => $response[0]]);
                } else {
                    \redirect()
                        ->route('user.signinView')
                        ->withErrors(['Este correo no se encuentra habilitado para acceder al sistema'])
                        ->withInput();
                }
            } else {
                return redirect()
                    ->route('user.signinView')
                    ->withErrors('Usuario y/o contraseña incorrecta')
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
