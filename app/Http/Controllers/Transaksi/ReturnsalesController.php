<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\TransaksiSales;
use App\TransaksiSalesDetail;
use App\TransaksiSalesTmp;
use App\Models\Sales;
use App\Models\Customer;
use DB;
use Session;

class ReturnsalesController extends Controller
{
    public function index()
    {
        $id = strlen(Session()->get('id'));
        $inv = DB::table('returnsales')->orderBy('id_returnsales', 'desc')->first();
        
        if ($id == 1) {
            $user = '00' . Session()->get('id');
        } else if ($id == 2) {
            $user = '0' . Session()->get('id');
        } else if ($id == 3) {
            $user = Session()->get('id');
        }

        if ($inv == NULL) {
            $invoice = 'RTS-' . date('Ym') . "-" . $user . '-1';
        } else {
            $cekinv = substr($inv->invoice_id, 15, 50);
            $plus = (int)$cekinv + 1;
            $invoice = 'RTS-' . date('Ym') . "-" . $user .  '-' . $plus;
        }
        $data['inv'] = $invoice;
        return view('pages.transaksi.salestransaksi.returntransaksi',$data);
    }

    public function showreturdetail($nama,$serch,$view,$type)
    {
        $data = DB::table('transaksi_sales')->get();
        return view('pages.transaksi.salestransaksi.tabelreturndetail');
    }
}