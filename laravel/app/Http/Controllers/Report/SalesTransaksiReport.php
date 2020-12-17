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

    public function table($ket_waktu, $filtertahun, $filterbulan, $filter_year, $waktuawal, $waktuakhir)
    {
        $data = DB::table('transaksi_sales');
        if ($ket_waktu == 1) {
            $data = $data->whereRaw('Date(invoice_date) = CURDATE()');
        }
        if ($ket_waktu == 2) {
            $data = $data->whereMonth('invoice_date', $filterbulan)->whereYear('invoice_date', $filtertahun);
        }
        if ($ket_waktu == 3) {
            $data = $data->whereYear('invoice_date', $filter_year);
        }
        if ($ket_waktu == 4) {
            $data = $data->whereBetween('invoice_date', [$waktuawal, $waktuakhir]);
        }
        $data = $data->get();

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
            if (!empty($customer)) {
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
        }
        return view('report.salestransaksi.table', compact('init'));
    }

    public function detailreport($id)
    {
        $data = DB::table('transaksi_sales_details')
            ->join('tbl_stok', 'tbl_stok.stok_id', 'transaksi_sales_details.stok_id')
            ->join('tbl_produk', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
            ->where('transaksi_sales_details.invoice_id', $id)
            ->get();
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
            $datas[] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'capital_price' => $a->capital_price,
                'total' => $a->quantity * $a->harga_satuan,
                'diskon' => $a->diskon,
                'amount' => ($a->quantity * $a->harga_satuan) - $a->diskon,
                'id_transaksi_tmp' => $a->id_transaksi_detail,
                'quantity' => implode(" ", $stok)
            );
        }
        return view('report.salestransaksi.tabledetail', compact('datas'));
    }
}
