<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SaleRepository;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    
    protected $saleRepository;

    public function __construct(SaleRepository $saleRepository){
        $this->saleRepository = $saleRepository;
    }

    public function store(Request $request)
    {
        return $this->saleRepository->store($request);
    }

    public function info(Request $request)
    {
        return $this->saleRepository->info($request);
    }

}
