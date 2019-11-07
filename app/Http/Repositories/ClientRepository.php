<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class ClientRepository
{


    public $messages =  [
        'document.required' => 'El campo document es necesario.'
    ];

    public function info($request) 
    { 
        try {
            $validator = Validator::make($request->all(), [
                'document-client' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $document = $request->input('document-client');
            $name = $request->input('name-client');
            $lastname = $request->input('lastname-client');
            $email = $request->input('email-client');
            $emailCorp = $request->input('emailCorp-client');
            $phone = $request->input('phone-client'); 
            $phoneCorp = $request->input('phoneCorp-client');
            $company = $request->input('company-client');

            $response = DB::select("CALL sp_get_product_inventory(?,?)", [
                $idProduct,
                $idWarehouse
            ]);

            if ($response) {
                return view('storeHouse.index')->with('products', $response);
            } else {
                return redirect('/'); 
            }

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }


    public function store($request) 
    { 
        try {
            $validator = Validator::make($request->all(), [
                'document-client' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $document = $request->input('document-client');
            $name = $request->input('name-client');
            $lastname = $request->input('lastname-client');
            $email = $request->input('email-client');
            $emailCorp = $request->input('emailCorp-client');
            $phone = $request->input('phone-client'); 
            $phoneCorp = $request->input('phoneCorp-client');
            $company = $request->input('company-client');
            
            
            $response = DB::select('CALL sp_insert_client(?,?,?,?,?,?,?,?)', [
                $name,
                $lastname,
                $email,
                $emailCorp,
                $phone,
                $phoneCorp,
                $company,
                $document
            ]);

            if ($response) {
                return redirect('client')->with('successMsg', 'Se registro el cliente exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al registrar cliente.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try
        {
            $response = DB::select('CALL sp_delete_client(?)', [
                $id
            ]);

            if ($response) {
                return redirect('client')->with('successMsg', 'Se elimino el cliente exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al eliminar cliente.'); // 0 o 2, 
            }

        } catch (\Exception $ex) {
        return back()
            ->withErrors($ex->getMessage())
            ->withInput();
        }
    }

    public function edit($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'document-client' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $document = $request->input('document-client');
            $name = $request->input('name-client');
            $lastname = $request->input('lastname-client');
            $email = $request->input('email-client');
            $emailCorp = $request->input('emailCorp-client');
            $phone = $request->input('phone-client'); 
            $phoneCorp = $request->input('phoneCorp-client');
            $company = $request->input('company-client');
            
            
            $response = DB::select('CALL sp_update_client(?,?,?,?,?,?,?,?)', [
                $name,
                $lastname,
                $email,
                $emailCorp,
                $phone,
                $phoneCorp,
                $company,
                $document
            ]);

            if ($response) {
                return redirect('client')->with('successMsg', 'Se registro el cliente exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al registrar cliente.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }
}
