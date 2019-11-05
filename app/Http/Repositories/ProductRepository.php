<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class ProductRepository
{


    public $messages =  [
        'cod-product.required' => 'El campo id-product es necesario.'
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
                'cod-product' => 'required',
                'category-product' => 'required',
                'price-product' => 'required',
                'brand-product' => 'required',
                'model-product' => 'required'
            ], $this->messages);

            if ($validator->fails()) {
                return redirect('home')
                    ->withErrors($validator)
                    ->withInput();
            }

            $codProduct = $request->input('cod-product');
            $categoryProduct = $request->input('category-product');
            $priceProduct = $request->input('price-product');
            $brandProduct = $request->input('brand-product');
            $modelProduct = $request->input('model-product');
            
            
            $response = DB::select('CALL sp_insert_product(?,?,?,?,?)', [
                $codProduct,
                $categoryProduct,
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

    public function destroy($id)
    {
        try
        {
            $response = DB::select('CALL sp_delete_product(?)', [
                $id
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

    public function editPrice($id,$price)
    {
        try
        {
            $response = DB::select('CALL sp_update_price_product(?,?)', [
                $id,
                $price
            ]);

            if ($response) {
                return redirect('product')->with('successMsg', 'Se actualizo el producto exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al actualizar el producto.'); // 0 o 2, 
            }

        } catch (\Exception $ex) {
        return back()
            ->withErrors($ex->getMessage())
            ->withInput();
        }
    }
}
