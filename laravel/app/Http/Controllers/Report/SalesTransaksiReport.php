<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransaksiSales;
use App\TransaksiSalesDetail;
use App\TransaksiSalesTmp;
use App\Models\Sales;
use App\Models\Customer;
use DB;
use Session;

class SalesTransaksiReport extends Controller
{
    public function index()
    {
        return view('report.salestransaksi.index');
    }

    // public function table(Request $r)
    // {
    //     $id = Session()->get('id');
    //     $date = date('Y-m-d');
    //     $data = DB::table('transaksi_sales_details')
    //         ->leftJoin('tbl_stok', 'tbl_stok.stok_id', 'transaksi_sales_details.stok_id')
    //         ->leftJoin('tbl_produk', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
    //         ->leftJoin('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
    //         ->select('tbl_produk.produk_id', 'tbl_produk.produk_brand', 'tbl_produk.produk_nama', 'tbl_produk.produk_harga', 'price', 'transaksi_sales_details.*', 'tbl_type_produk.nama_type_produk', 'tbl_stok.stok_id')
    //         ->where('transaksi_sales_details.id_user', $id)
    //         ->where('transaksi_sales_details.invoice_date', $date)
    //         ->get();
    //     // dd($data);
    //     $init = [];
    //     $format = '%d %s |';
    //     $stok = [];
    //     foreach ($data as $i => $a) {
    //         $proses = DB::table('tbl_unit')->where('produk_id', $a->produk_id)
    //             ->join('tbl_satuan', 'tbl_unit.maximum_unit_name', '=', 'tbl_satuan.id_satuan')
    //             ->select('id_unit', 'nama_satuan as unit', 'default_value')
    //             ->orderBy('id_unit', 'ASC')
    //             ->get();
    //         // nilai jumlah dari tabel stok
    //         $jumlah = $a->quantity;
    //         $hasilbagi = 0;
    //         $stokquantity = [];
    //         foreach ($proses as $index => $list) {
    //             $banyak = sizeof($proses);
    //             if ($index == 0) {
    //                 $sisa = $jumlah % $list->default_value;
    //                 $hasilbagi = ($jumlah - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $value[$index] = $list->default_value;
    //                 $lebih[$index] = $sisa;
    //                 if ($sisa > 0) {
    //                     $stok[] = sprintf($format, $sisa, $list->unit);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             } else if ($index == 1) {
    //                 $sisa = $hasilbagi % $list->default_value;
    //                 $hasilbagi = ($hasilbagi - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $value[$index] = $list->default_value;
    //                 $lebih[$index] = $sisa;
    //                 if ($sisa > 0) {
    //                     $stok[] = sprintf($format, $sisa + $lebih[$index - 1], $satuan[$index - 1]);
    //                 } else {
    //                     $stok[] = sprintf($format, 0, $satuan[$index - 1]);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             } else if ($index == 2) {
    //                 $sisa = $hasilbagi % $list->default_value;
    //                 $hasilbagi = ($hasilbagi - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $value[$index] = $list->default_value;
    //                 $lebih[$index] = $sisa;
    //                 if ($sisa > 0) {
    //                     $stok[] = sprintf($format, $sisa, $satuan[$index - 1]);
    //                 } else {
    //                     $stok[] = sprintf($format, 0, $satuan[$index - 1]);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             }
    //         }
    //         $init[] = array(
    //             'stok_id' => $a->stok_id,
    //             'produk_id' => $a->produk_id,
    //             'nama_type_produk' => $a->nama_type_produk,
    //             'produk_brand' => $a->produk_brand,
    //             'produk_nama' => $a->produk_nama,
    //             'produk_harga' => number_format($a->price),
    //             'total' => number_format($a->quantity * $a->harga_satuan),
    //             'diskon' => number_format($a->diskon),
    //             'tot' => 0,
    //             'amount' => ($a->quantity * $a->harga_satuan) - $a->diskon,
    //             'id_transaksi_detail' => $a->id_transaksi_detail,
    //             'quantity' => implode(" ", $stokquantity)
    //         );
    //     }
    //     return view('report.salestransaksi.table', compact('init'));
    // }

    public function table()
    {
        $data = DB::table('transaksi_sales')->get();
        $init = array();
        foreach ($data as $a) {
            $sales = DB::table('tbl_sales')->where('id_sales', $a->sales_id)->first();
            if ($sales == NULL) {
                $namasales = '';
            } else {
                $namasales = $sales->nama_sales;
            }
            // ======================================
            $customer = DB::table('tbl_customer')->where('id_customer', $a->customer_id)->first();
            $init[] = array(
                'id_transaksi_sales' => $a->id_transaksi_sales,
                'invoice_id' => $a->invoice_id,
                'invoice_date' => $a->invoice_date,
                'term_until' => $a->term_until,
                'totalsales' => $a->totalsales,
                'dp' => $a->dp,
                'diskon' => $a->diskon,
                'status' => $a->status,
                'transaksi_tipe' => $a->transaksi_tipe,
                'nama_sales' => $namasales,
                'nama_customer' => $customer->nama_customer,
                'id_cabang' => $customer->id_cabang
            );
        }
        return view('report.salestransaksi.table', compact('init'));
    }
}
