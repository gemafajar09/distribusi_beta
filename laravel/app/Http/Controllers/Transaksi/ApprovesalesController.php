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
        $data['list'] = DB::table('transaksi_sales')
            ->join('tbl_sales','tbl_sales.id_sales','transaksi_sales.sales_id')
            ->where('transaksi_sales.approve',0)
            ->get();
        return view('pages.transaksi.salestransaksi.approve',$data);
    }

    public function approve(Request $r)
    {
        $status = $r->status;
        $id_transaksi = $r->id_transaksi;
        $edit = DB::table('transaksi_sales')->where('id_transaksi_sales',$id_transaksi)->update(['approve' => $status]);
        $cek = DB::table('transaksi_sales_details')->where('invoice_id',$r->invoice_id)->get();
        foreach($cek as $i => $a)
        {
            $lihat = DB::table('tbl_stok')->where('stok_id',$a->stok_id)->first();
            $stok = $lihat->jumlah - $a->quantity;
            DB::table('tbl_stok')->where('stok_id',$a->stok_id)->update(['jumlah' => $stok]);
        }
        if($edit == TRUE)
        {
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
}