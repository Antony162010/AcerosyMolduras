<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProviderRepository;
use App\Provider;
use Illuminate\Http\Request;
use DB;


class ProviderController extends Controller
{   

    protected $providerRepository;

    public function __construct(ProviderRepository $providerRepository){
        $this->providerRepository = $providerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->providerRepository->store($request);
    }

    
    public function show($email) /* Muestra proveedor según email, usado para insertar los datos
    del proveedor al realizar una compra. */
    {
        $provider = DB::select('CALL sp_get_provider(?)', [$email]);
        return view('layout.home')->with('provider', $provider); 
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
}
