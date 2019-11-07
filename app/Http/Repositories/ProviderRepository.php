<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class ProviderRepository
{

    public $messages =  [
        'name.required' => 'El campo name es necesario.',
        'email.required' => 'El campo email es necesario.',
        'phone.required' => 'El campo phone es necesario.',
        'avenue.required' => 'El campo avenue es necesario.'
    ];

    public function store($request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required', 
                'phone' => 'required', 
                'avenue' => 'required'
            ], $this->messages);

            
            if ($validator->fails()) {
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $name = $request->input('name');
            $email = $request->input('email'); //PK, siempre dif
            $phone = $request->input('phone');
            $avenue = $request->input('avenue');

            $response = DB::select("CALL sp_insert_provider(?,?,?,?)", [
                $name,
                $email,
                $phone,
                $avenue
            ]);

            if ($response) {
                return redirect('home')->with('successMsg', 'Se inserto el proveedor.');
            } else {
                return redirect('')->with('errorMsg', 'Error al insertar el producto.');
            }
        } catch (\Exception $ex) {
            dd($ex);
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }
}
