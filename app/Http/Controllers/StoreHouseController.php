<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StoreHouseRepository;
use Illuminate\Http\Request;
use DB;

class StoreHouseController extends Controller
{
    protected $storeHouseRepository;

    public function __construct(StoreHouseRepository $storeHouseRepository)
    {
        $this->storeHouseRepository = $storeHouseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Trae todos los productos según el almacén - Funciona */
        $products = DB::select('CALL sp_get_warehouse_inventory(?)', ['SH001']);
        return view('storeHouse.index')->with(['products' => $products, 'warehouseId' => 'SH001']);
    }

    public function info(Request $request)
    {
        /* Información de un producto por almacén. - Funciona*/
        return $this->storeHouseRepository->info($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Insertar un producto en un almacén con una determinada cantidad - Funciona */
        return $this->storeHouseRepository->store($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = DB::select('CALL sp_get_warehouses()');
        return view('storeHouse.create')->with(['warehouses' => $warehouses]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr = explode(';', $id);
        $warehouse = DB::select('CALL sp_get_product_inventory(?,?)', [$arr[1], $arr[0]]);
        return view('storeHouse.edit')->with(['warehouse' => $warehouse[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return $this->storeHouseRepository->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }

    public function productsByWarehouse(Request $request)
    {
        $products = DB::select('CALL sp_get_products()');
        return json_encode($products);
    }

    public function indexPdf()
    {
        return view('pdf.index');
    }

    public function generatePdf(Request $request)
    {
        return $this->storeHouseRepository->generatePdf($request);
    }

    public function getProductsByDate(Request $request)
    {
        return $this->storeHouseRepository->getProductsByDate($request);
    }
}
