<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class ProductRepository
{


    public $messages =  [
        'id-product.required' => 'El campo id-product es necesario.'
    ];

    public function info($request) 
    { 
        try {
            $validator = Validator::make($request->all(), [
                'id-product' => 'required',
                'id-warehouse'=>'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('/home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $idProduct = $request->input('id-product');
            $idWarehouse = $request->input('id-warehouse');

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
                'cod_product' => 'required', 
                'category_product' => 'required',
                'price_product' => 'required', 
                'brand_product' => 'required', 
                'model_product' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $codProduct = $request->input('cod_product');
            $categoryProduct = $request->input('category_product');
            $priceProduct = $request->input('price_product');
            $brandProduct = $request->input('brand_product');
            $modelProduct = $request->input('model_product');
            
            $response = DB::select('CALL sp_insert_product(?,?,?,?,?)', [
                $codProduct,
                $categoryProd,
                $priceProduct,
                $brandProduct,
                $modelProduct
            ]);

            if ($response) {
                return redirect('product')->with('successMsg', 'Se registro el producto exitosamente.');
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
