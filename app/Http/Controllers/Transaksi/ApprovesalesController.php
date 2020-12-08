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
        if($edit == TRUE)
        {
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
}