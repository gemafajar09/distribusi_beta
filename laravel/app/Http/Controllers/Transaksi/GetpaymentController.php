<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransaksiSales;
use App\Getpayment;
use DB;

class GetpaymentController extends Controller
{
    public function index()
    {
        return view('pages.transaksi.getpayment.index');
    }

    public function getcredit(Request $r)
    {
        $ids = $r->id_transkasi;
        $inv = DB::table('tbl_getpayment')->orderBy('id_getpayment','desc')->first();

        if($inv == NULL)
        {
            $invoice = 'CC-'.date('Ym')."-".date('H')."-1";
        }else{
            $cekinv = substr($inv->invoice_id,13,50);
            $plus = (int)$cekinv + 1;
            $invoice = 'CC-'.date('Ym')."-".date('H').'-'.$plus;
        }
        $data = DB::table('transaksi_sales')
                    ->join('tbl_customer','tbl_customer.id_customer','transaksi_sales.customer_id')
                    ->where('transaksi_sales.invoice_id',$ids)
                    ->first();
                    if($data == TRUE)
                    {
                        return response()->json(['status' => 200, 'data' => $data, 'invoice' => $invoice]);
                    }else{
                        return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
                    }
    }

    public function caricustomer(Request $r)
    {
        $datas = DB::table('transaksi_sales')
            ->join('tbl_customer', 'tbl_customer.id_customer', 'transaksi_sales.customer_id')
            ->join('tbl_sales', 'tbl_sales.id_sales', 'transaksi_sales.sales_id')
            ->where('transaksi_sales.transaksi_tipe', 'Credit')
            ->where('transaksi_sales.status', 'UNPAID')
            ->where('transaksi_sales.approve', '1')
            ->where('tbl_customer.nama_customer','Like','%'.$r->nama.'%')
            ->get();
            // dd($datas);

        if($datas == TRUE)
        {
            $data['hasil'] = [];
            foreach($datas as $a)
            {
                $cek = DB::table('tbl_getpayment')->where('invoice_id',$a->invoice_id)->first();
                
                if($cek == TRUE)
                {
                    $payment = $cek->payment;
                    $sisa = $a->totalsales - $cek->payment;
                }else{
                    $payment = 0;
                    $sisa = $a->totalsales - 0;
                }
                $data['hasil'][] = array(
                    'invoice_id' => $a->invoice_id,
                    'invoice_date' => $a->invoice_date,
                    'nama_customer' => $a->nama_customer,
                    'nama_sales' => $a->nama_sales,
                    'totalsales' => $a->totalsales,
                    'payment' => $payment,
                    'remaining' => $sisa,
                    'term_until' => $a->term_until,
                    'status' => $a->status
                );
            }
        }else{
            $data['hasil'] = array(
                'invoice_id' => '',
                'invoice_date' => '',
                'nama_customer' => '',
                'nama_sales' => '',
                'totalsales' => '',
                'payment' => '',
                'remaining' => '',
                'term_until' => '',
                'status' => ''
            );
        }
        return view('pages.transaksi.getpayment.tabelpayment', $data);
    }

    public function detailtrans(Request $r)
    {
        $invoices = $r->id_transaksi;
        
        $data = DB::table('transaksi_sales_details')
            ->join('tbl_stok', 'tbl_stok.stok_id', 'transaksi_sales_details.stok_id')
            ->join('tbl_produk', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
            ->select('tbl_produk.produk_id', 'tbl_produk.produk_brand', 'tbl_produk.produk_nama', 'tbl_produk.produk_harga', 'price', 'transaksi_sales_details.*', 'tbl_type_produk.nama_type_produk', 'tbl_stok.stok_id')
            ->where('transaksi_sales_details.invoice_id', $invoices)
            ->get();
        
        $detail = [];
        $format = '%d %s |';
        $stok = [];
        foreach ($data as $a) {
            $proses = DB::table('tbl_unit')->where('produk_id', $a->produk_id)
                ->join('tbl_satuan', 'tbl_unit.maximum_unit_name', '=', 'tbl_satuan.id_satuan')
                ->select('id_unit', 'nama_satuan as unit', 'default_value')
                ->orderBy('id_unit', 'ASC')
                ->get();
            $hasilbagi = 0;
            foreach ($proses as $index => $list) {
                $banyak =  sizeof($proses);
                $sisa = $a->quantity % $list->default_value;
                $hasilbagi = ($a->quantity - $sisa) / $list->default_value;
                $satuan[$index] = $list->unit;
                $value_default[$index] = $list->default_value;
                $lebih[$index] = $sisa;
                if ($index == 0) {
                    if ($sisa > 0) {
                        $stok[$index] = sprintf($format, $sisa, $list->unit);
                    }
                    if ($banyak == $index + 1) {
                        $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                    }
                } else if ($index == 1) {
                    if ($sisa > 0) {
                        $stok[$index - 1] = sprintf($format, $sisa + $lebih[$index - 1], $satuan[$index - 1]);
                    }
                    if ($banyak == $index + 1) {
                        $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                    }
                } else if ($index == 2) {
                    if ($sisa > 0) {
                        $stok[$index - 1] = sprintf($format, $sisa,  $satuan[$index - 1]);
                    }
                    if ($banyak == $index + 1) {
                        $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                    }
                }
            }
            $detail[] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'produk_harga' => number_format($a->price),
                'total' => number_format($a->quantity * $a->harga_satuan),
                'diskon' => number_format($a->diskon),
                'tot' => 0,
                'amount' => ($a->quantity * $a->harga_satuan) - $a->diskon,
                'id_transaksi_tmp' => $a->id_transaksi_detail,
                'quantity' => implode(" ", $stok)
            );
        }
        return view('pages.transaksi.getpayment.tabeldetail', compact('detail'));
    }

    public function addpayment(Request $r)
    {
        $invoice = $r->invoice_id;
        $data = DB::table('transaksi_sales')->where('invoice_id',$invoice)->first();
        if($data->totalsales == $r->payment)
        {
            DB::table('transaksi_sales')->where('id_transaksi_sales',$data->id_transaksi_sales)->update(['status' => 'PAID']);
        }
        $simpan = new Getpayment();
        $simpan->payment_id = $r->payment_id;
        $simpan->invoice_id = $r->invoice_id;
        $simpan->tgl_payment = date('Y-m-d');
        $simpan->payment = $r->payment;
        $simpan->status = $r->status;
        $simpan->save();
    }
}
