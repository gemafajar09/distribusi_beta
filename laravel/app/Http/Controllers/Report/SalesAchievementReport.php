<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SalesAchievementReport extends Controller
{
    public function index()
    {
        $cabang = Session()->get('cabang');
        $data = DB::table('tbl_sales')->where('id_cabang', $cabang)->get();
        return view("report.salesachievement.index", compact('data'));
    }

    public function ambiltarget($id)
    {
        $data = DB::table('tbl_sales')->where('id_sales', $id)->first();
        echo json_encode($data);
    }

    public function transaksisales($id)
    {
        $data = DB::table('transaksi_sales')
            ->join('tbl_customer', 'transaksi_sales.customer_id', 'tbl_customer.id_customer')
            ->where('sales_id', $id)
            ->get();
        // dd($data);
        return view("report.salesachievement.table", compact('data'));
    }

    public function printallstock()
    {
        $data = DB::table('transaksi_sales_details')
            ->join('tbl_stok', 'tbl_stok.stok_id', 'transaksi_sales_details.stok_id')
            ->join('tbl_produk', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
            ->join('transaksi_sales', 'transaksi_sales.invoice_id', 'transaksi_sales_details.invoice_id')
            ->get();
        // dd($data);
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
                'produk_id' => $a->produk_id,
                'produk_nama' => $a->produk_nama,
                'quantity' => implode(" ", $stok)
            );
        }
        return view("report.salesachievement.printallstock", compact('datas'));
    }

    public function printtostock()
    {
        return view("report.salesachievement.printtostock");
    }

    public function printcanvasstock()
    {
        return view("report.salesachievement.printcanvasstock");
    }
}
