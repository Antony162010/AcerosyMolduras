<?php

namespace App\Http\Controllers;

use App\Http\Repositories\StoreHouseRepository;
use Illuminate\Http\Request;
use DB;

class StoreHouseController extends Controller
{   
    protected $storeHouseRepository;

    public function __construct(StoreHouseRepository $storeHouseRepository){
        $this->storeHouseRepository = $storeHouseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = DB::select('CALL sp_get_store_house_products(?)', [date_format(now(), 'Y-m-d')]);

        // return view('storeHouse.index')->with('products', $products);
        return view('storeHouse.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storeHouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->storeHouseRepository->store($request);
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
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
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

    public function info(Request $request){
        return $this->storeHouseRepository->info($request);
    }

}
