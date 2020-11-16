<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\TransaksiSales;
use App\TransaksiSalesDetail;
use App\TransaksiSalesTmp;

class TransaksiSalesController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_transaksi_sales' => 'numeric',
            'id_transaksi_detail' => 'numeric',
            'id_transaksi_tmp' => 'numeric',
            'sales_id' => 'numeric',
            'stok_id' => 'numeric',
            'qty_carton' => 'numeric',
            'qty_cup' => 'numeric',
            'qty_pcs' => 'numeric',
            'qty_bungkus' => 'numeric',
            'customer_id' => 'numeric',
            'invoice_id' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'transaksi_tipe' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'note' => 'required|regex:/(^[A-Za-z0-9 .]+$)+/',

        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'

        );
    }

    public function index()
    {
        return view('pages.transaksi.salestransaksi.index');
    }
}
