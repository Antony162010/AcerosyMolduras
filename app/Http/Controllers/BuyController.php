<?php

namespace App\Http\Controllers;

use App\Http\Repositories\BuyRepository;
use Illuminate\Http\Request;
use DB;

class BuyController extends Controller
{

    protected $buyRepository;

    public function __construct(BuyRepository $buyRepository)
    {
        $this->buyRepository = $buyRepository;
    }

    public function index()
    {
        $purchases = DB::select('CALL sp_get_purchases()');
        return view('buy.index')->with(['purchases' => $purchases]);
    }

    public function create()
    {
        $providers = DB::select('CALL sp_get_providers()');
        return view('buy.create')->with([
            'providers' => $providers
        ]);
    }

    public function store(Request $request)
    {
        return $this->buyRepository->store($request);
    }

    public function show($id)
    {
        return $this->buyRepository->show($id);
    }

    public function getProducts(Request $request)
    {
        return $this->buyRepository->getProducts($request);
    }

    public function destroy($id)
    {
        return $this->buyRepository->destroy($id);
    }
}
