<?php

namespace App\Http\Repositories;

use Illuminate\Support\Str;

use DB;
use Validator;

class SaleRepository
{

    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idproduct' => 'required',
                'prodquantity' => 'required',
                'prodprice' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect(route('sale.create'))
                    ->withErrors($validator)
                    ->withInput();
            }
            
            //Arrays que se reciben desde la vista (ids y cantidades)
            $district = $request->input('district');
            $idProduct = $request->input('idproduct');
            $prodQuantity = $request->input('prodquantity');
            $prodPrice = $request->input('prodprice');
            $idAdmin = $_SESSION['user_session']['user_id'];

            //Variables que guardarán en un string los ids y cantidades, 1;2;3;4;5
            $arrayId = '';
            $arrayQty = '';
            $arrayPrice = '';

            if (sizeof($idProduct) == sizeof($prodQuantity)) { //Si las tres cadenas son iguales 
                if (sizeof($idProduct) == sizeof($prodPrice)) {
                    if (sizeof($prodQuantity) == sizeof($prodPrice)) {

                        /*Me manda un array de ids y las paso a string concatenandolas (1;2;3;4) 
                        $idProduct es todo el array [1,2,3] y $id es un elemento de este -> 1 */
                        foreach ($idProduct as $id) { //Recibo [1,2,3]
                            $arrayId = $arrayId . ';' . $id; //Se vuelve '1;2;3' (string)
                        }


                        foreach ($prodQuantity as $prodQty) { //Recibo [20;30;40]
                            $arrayQty = $arrayQty . ';' . $prodQty; //Se vuelve '20;30;40' (string)
                        }

                        foreach ($prodPrice as $prodPce) { //Recibo [40;50;60]
                            $arrayPrice = $arrayPrice . ';' . $prodPce;
                        }

                        $arrayId = Str::replaceArray(';', [''], $arrayId);
                        $arrayQty = Str::replaceArray(';', [''], $arrayQty);
                        $arrayPrice = Str::replaceArray(';', [''], $arrayPrice);
                        /*replaceArray recorre todo el string buscando ';', y de acuerdo a la cantidad
                        de cosas en el array, reemplaza. Como solo se tiene un objeto en el array,
                        lo reemplaza solo una vez. */

                        //dd($arrayId . ' ' . $arrayQty . ' ' . $arrayPrice);

                        $response = DB::select("CALL demo_sp_insert_product_has_sale(?,?,?,?,?)", [
                            $arrayId,
                            $arrayQty,
                            $arrayPrice, //En la db estos strings se separan segun el ';' y se insertan.
                            $idAdmin,
                            $district
                        ]);   

                        if ($response[0]->response) {
                            return redirect(route('sale.index'))->with('successMsg', 'Venta registrada.');
                        } else {
                            return redirect(route('sale.index'))->with('errorMsg', 'Error al registrar la venta.');
                        }
                    }
                }

                /* Problema a solucionar: inserta una fila de puros vacios porque concatena '';1;2;3 */
            } else {

                return redirect(route('sale.index'))->with('errorMsg', 'Error al registrar la venta.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return view('error.internalServelError');
        }
    }


    public function show($id)
    {
        $response = DB::select("CALL demo_sp_get_product_has_sale(?)", [
            $id
        ]);

        $departments = DB::select('CALL sp_get_departments()');
        if (sizeof($response) > 0) {
            /* Trae los datos del administrador que se repiten en un join*/
            $saleData = array([
                'id_sale' => $response[0]->idsale,
                'department' => $response[0]->iddepar,
                'idProv' => $response[0]->idProv,
                'province' => $response[0]->province,
                'iddistrict' => $response[0]->iddistrict,
                'district' => $response[0]->district,
                'date' => $response[0]->date,
                'provider_email' => $response[0]->provider_email,
                'name' => $response[0]->name,
                'total_price' => $response[0]->totalprice,
                'site' => $response[0]->district . ', ' . $response[0]->province . ', ' . $response[0]->department
            ]);

            return view('sale.info')->with([
                'products' => $response,
                'sale' => $saleData[0],
                'departments' => $departments
            ]);
        } else {
            return view('sale.info')->with(['sale' => [], 'products' => [], 'departments' => $departments]);
        }
    }


    public function getProducts($request)
    {
        $products = DB::select('CALL sp_get_products()');
        return json_encode($products);
    }

    public function getProvinces($request)
    {
        $provinces = DB::select('CALL sp_get_provinces(?)', [$request->idDepartment]);
        return json_encode($provinces);
    }

    public function getDistricts($request)
    {
        $districts = DB::select('CALL sp_get_districts(?)', [$request->idProvince]);
        return json_encode($districts);
    }
    /*
            1. Funcion para mostrar todas las ventas con sus productos respectivos por id de venta
            (idSale)

            //Jalar datos repetidos de la venta del join entre product_has_sale y sale, para mostrar 
            toda una venta //

            if(sizeof($response) > 0){
                    $obj = array([
                        "name" => $response[0]->nameAdministrator
                    ]);

                    return view()->with(['obj'=> json_encode($obj)], 'msg'); //retorna objeto
                }
            
            2.  


            */
}
