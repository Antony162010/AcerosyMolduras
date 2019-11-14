<?php

namespace App\Http\Repositories;

use Illuminate\Support\Str;
use App\BuyDetail;

use DB;
use Validator;

class BuyRepository
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
            $idprovider = $request->input('provider');
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

                        $response = DB::select("CALL sp_insert_buy(?,?,?,?,?)", [
                            $idprovider,
                            $idAdmin,
                            $arrayId,
                            $arrayQty,
                            $arrayPrice
                        ]);

                        if ($response[0]->response) {
                            return redirect(route('buy.index'))->with('successMsg', 'Compra registrada.');
                        } else {
                            return redirect(route('buy.index'))->with('errorMsg', 'Error al registrar la compra.');
                        }
                    }
                }

            } else {

                return redirect(route('buy.index'))->with('errorMsg', 'Error al registrar la compra.');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return view('error.internalServelError');
        }
    }


    public function show($id)
    {
        $response = DB::select("CALL sp_get_buy_details(?)", [
            $id
        ]);

        $providers = DB::select('CALL sp_get_providers()');
        if (sizeof($response) > 0) {
            /* Trae los datos del administrador que se repiten en un join*/
            $buyData = array([
                'idbuy' => $response[0]->idbuy,
                'idprovider' => $response[0]->idprovider,
                'date' => $response[0]->date,
                'administrator' => $response[0]->administrator,
                'total' => $response[0]->total
            ]);

            return view('buy.info')->with([
                'products' => $response,
                'buy' => $buyData[0],
                'providers' => $providers
            ]);
        } else {
            return view('buy.info')->with(['buy' => [], 'products' => [], 'providers' => $providers]);
        }
    }

    public function destroy($id)
    {
        try
        {
            $response = DB::select('CALL sp_delete_buy(?)', [
                $id
            ]);

            if ($response) {
                return redirect('buy')->with('successMsg', 'Se elimino la compra exitosamente.');
            } else {
                return redirect('')->with('errorMsg', 'Error al eliminar la compra.'); // 0 o 2, 
            }

        } catch (\Exception $ex) {
        return back()
            ->withErrors($ex->getMessage())
            ->withInput();
        }
    }

    public function getProducts($request)
    {
        $products = DB::select('CALL sp_get_products()');
        return json_encode($products);
    }

}
