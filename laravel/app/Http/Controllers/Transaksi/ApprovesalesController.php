<?php

namespace App\Http\Controllers\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransaksiSales;
use DB;

class ApprovesalesController extends Controller
{
    public function index()
    {
        $trans = DB::table('transaksi_sales')
            ->where('transaksi_sales.approve','0')
            ->get();
        $data['list'] = array();
        foreach($trans as $a)
        {
            $sales = DB::table('tbl_sales')->where('id_sales',$a->sales_id)->first();
            
            $data['list'][] = array(
                'invoice_id' => $a->invoice_id,
                'invoice_date' => $a->invoice_date,
                'totalsales' => $a->totalsales,
                'diskon' => $a->diskon,
                'id_transaksi_sales' => $a->id_transaksi_sales,
                'nama_sales' => $sales->nama_sales
            );
        }
        return view('pages.transaksi.salestransaksi.approve',$data);
    }

    public function approve(Request $r)
    {
        $status = $r->status;
        $id_transaksi = $r->id_transaksi;
        $edit = DB::table('transaksi_sales')->where('id_transaksi_sales',$id_transaksi)->update(['approve' => $status]);
        // $cek = DB::table('transaksi_sales_details')->where('invoice_id',$r->invoice_id)->get();
        // foreach($cek as $i => $a)
        // {
        //     $lihat = DB::table('tbl_stok')->where('stok_id',$a->stok_id)->first();
        //     $stok = $lihat->jumlah - $a->quantity;
        //     DB::table('tbl_stok')->where('stok_id',$a->stok_id)->update(['jumlah' => $stok]);
        // }
        if($edit == TRUE)
        {
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function detailapp($id)
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
        return view('pages.transaksi.salestransaksi.tabledetailapp',compact('datas'));
    }
}