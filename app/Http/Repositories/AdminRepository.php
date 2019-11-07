<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class AdminRepository
{

    public function signin($request)
    {
        try {
            $userEmail = trim($request->input('user-email'));
            $userPassword = trim($request->input('user-password'));

            $response = DB::select('call sp_signin_admin(?,?)', [
                $userEmail,
                $userPassword,
            ]);

            // dd($response);
            if (sizeof($response) > 0) {
                $_SESSION['user_session'] = array(
                    "user_name" => $response[0]->name,
                    "user_email" => $response[0]->username
                );
                return \redirect()->route('home')->with(['user' => $response[0]]);
            } else {
                return redirect()
                    ->route('login')
                    ->withErrors('Usuario y/o contraseña incorrecta')
                    ->withInput();
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_session']);
        return redirect()->route('login');
    }
}
