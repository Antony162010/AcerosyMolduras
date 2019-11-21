<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\QuotationRepository;
use DB;

class QuotationController extends Controller
{
    protected $quotationRepository;

    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    public function index()
    {
        $quotations = DB::select('CALL demo_sp_get_quotations()');
        return view('quotation.index')->with(['quotations' => $quotations]);
    }

    public function show($id) //Mostrar cotización según id
    {
        return $this->quotationRepository->show($id);
    }

}
