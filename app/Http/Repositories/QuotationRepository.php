<?php

namespace App\Http\Repositories;

use Illuminate\Support\Str;

use DB;
use Validator;

class QuotationRepository
{

    public function show($id)
    {
        $response = DB::select("CALL demo_sp_get_product_has_quotation(?)", [
            $id
        ]);

        if (sizeof($response) > 0) {
            /* Trae los datos de la cotización que se repiten en un join, incluye el precio total */
            $quotationData = array([
                'id-quotation' => $response[0]->idquotation,
                'client-document' => $response[0]->client_document,
                'date' => $response[0]->date,
                'total-price' => $response[0]->totalprice,
                'client-name' => $response[0]->c_name,
                'client-lname' => $response[0]->last_name,
                'email' => $response[0]->email,
                'phone' => $response[0]->phone
            ]);
            
            return ([$quotationData, $response]);/*view('quotation')->with([
                'products' => $response,
                'quotation' => $quotationData[0]
            ]);*/
        } else {
            return view('sale.info')->with(['sale' => [], 'products' => []]);
        }
    }
}
