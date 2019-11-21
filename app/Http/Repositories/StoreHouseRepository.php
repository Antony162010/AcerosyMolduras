<?php

namespace App\Http\Repositories;

use Illuminate\Support\Str;
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

    public function generatePdf($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idproduct' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect(route('store_house.index.catalog'))
                    ->withErrors($validator)
                    ->withInput();
            }

            //Arrays que se reciben desde la vista (ids)
            $idProduct = $request->input('idproduct');

            //Variables que guardarán en un string los ids y cantidades, 1;2;3;4;5
            $arrayId = '';

            /*Me manda un array de ids y las paso a string concatenandolas (1;2;3;4) 
                        $idProduct es todo el array [1,2,3] y $id es un elemento de este -> 1 */
            foreach ($idProduct as $i => $id) { //Recibo [1,2,3]
                if ($i == 0)
                    $arrayId = '"' . $id . '"';
                else
                    $arrayId = $arrayId . ',"' . $id . '"'; //Se vuelve '1;2;3' (string)
            }

            $response = DB::select("CALL sp_get_for_pdf(?)", [
                $arrayId
            ]);

            if (sizeof($response) > 0) {

                $categories = DB::select("CALL sp_get_categories()");

                $obj = array();

                foreach ($categories as $cat) {
                    $obj[$cat->idcategory] = array();
                    foreach ($response as $res) {
                        if ($cat->idcategory == $res->category_idcategory) {
                            \array_push($obj[$cat->idcategory], $res);
                        }
                    }
                }

                $pdf = \PDF::loadView('pdf.catalog', [
                    'products' => $obj,
                    'categories' => $categories
                ]);

                return $pdf->download('Catálogo.pdf');
            } else {
                return redirect(route('store_house.index.catalog'))
                    ->withInput()
                    ->with('errorMsg', 'No hay productos para crear el catálogo PDF.');
            }
        } catch (Exception $e) {
            return view('error.internalServelError');
        }
    }
}
