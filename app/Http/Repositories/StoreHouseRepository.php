<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class StoreHouseRepository
{


    public $messages =  [
        'id-product.required' => 'El campo id-product es necesario.'
    ];

    public function info($request){ //de un producto en un almacén
        try{
            $validator = Validator::make($request->all(), [
                'id-product'=>'required',
                //'id-warehouse'=>'required'
            ], $this->messages);

            if($validator->fails()){
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $idProduct = $request->input('id-product');
            //$idWarehouse = $request->input('id-warehouse');
            //Logica

            $response = DB::select("CALL sp_get_product_inventory(?)", [
                $idProduct,
                //$idWarehouse
                ]);

            /*if($response == null){
                return redirect('/product');
            }*/
            
            if ($response) {
                
                return view('store_house.index')->with(['data' => $response]); //corregir this
                
            } else{
                return redirect('/'); 
            }

        }catch (\Exception $ex){
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }


    public function store($request){
        try {
            $validator = Validator::make($request->all(), [
                'id-warehouse' => 'required', //idstore_house
                'id-product' => 'required', //idproduct
                'boxes-quantity' => 'required', //boxes_quantity
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $idWarehouse = $request->input('id-warehouse');
            $idProduct = $request->input('id-product');
            $boxesQuantity = $request->input('boxes-quantity');

            $response = DB::select("CALL sp_insert_product_warehouse(?,?,?)", [
                $idWarehouse,
                $idProduct,
                $boxesQuantity
            ]);

            if ($response[0]->response == 1) {
                return redirect('store_house')->with('successMsg', 'Se guardo el producto en almacén.'); 
                //response 1, go almacen ¿Porque 1 y 2 los cuenta acá? wtf 
            } else {
                return redirect('')->with('errorMsg', 'Error al insertar el producto.'); // 0 o 2, 
            }

        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

}