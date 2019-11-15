<?php

namespace App\Http\Repositories;

use DB;
use Validator;

class StoreHouseRepository
{


    public $messages =  [
        'id-product.required' => 'El campo id-product es necesario.'
    ];

    public function info($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id-product' => 'required',
                'id-warehouse' => 'required'
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
                'id-warehouse' => 'required', //idstore_house
                'id-product' => 'required', //idproduct
                'boxes-quantity' => 'required', //boxes_quantity
            ], $this->messages);

            if ($validator->fails()) {
                return redirect(route('store_house.create'))
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

            if ($response) {
                return redirect(route('store_house.index'))->with('successMsg', 'Se guardo el producto en almacén.');
            } else {
                return redirect(route('store_house.create'))->with('errorMsg', 'Error al insertar el producto.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

    public function update($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id-warehouse' => 'required', //idstore_house
                'id-product' => 'required', //idproduct
                'boxes-quantity' => 'required', //boxes_quantity
            ], $this->messages);

            if ($validator->fails()) {
                return redirect(route('store_house.update'))
                    ->withErrors($validator)
                    ->withInput();
            }

            $idWarehouse = $request->input('id-warehouse');
            $idProduct = $request->input('id-product');
            $boxesQuantity = $request->input('boxes-quantity');

            $response = DB::select('CALL sp_update_product_warehouse(?,?,?)', [
                $boxesQuantity,
                $idWarehouse,
                $idProduct
            ]);

            if ($response[0]->response) {
                return redirect(route('store_house.index'))->with('successMsg', 'Se actualizo el producto exitosamente.');
            } else {
                return redirect(route('store_house.update'))->with('errorMsg', 'Error al actualizar el producto.'); // 0 o 2, 
            }
        } catch (\Exception $ex) {
            return back()
                ->withErrors($ex->getMessage())
                ->withInput();
        }
    }

    public function getProducts()
    {
        $products = DB::select('CALL sp_get_products()');
        return json_encode($products);
    }

    public function generatePdf($request)
    {
        $pdf = \PDF::loadView('pdf.catalog', [
            'nuevo' => 14
        ]);

        return $pdf->download('Catálogo.pdf');
    }
}
