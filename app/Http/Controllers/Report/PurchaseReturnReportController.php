<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransaksiPurchaseReturn;
use Illuminate\Support\Facades\DB;
class PurchaseReturnReportController extends Controller
{
    public function index(){
        return view('report.purchasereturn.index');
    }
    

    public function all_datatable(){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')->get();
        return datatables()->of($data)->toJson();
    }

    public function today_datatable(){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereRaw('Date(return_date) = CURDATE()')->get();;
        return datatables()->of($data)->toJson();
    }

    public function month_datatable($month,$year){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereMonth('return_date',$month)->whereYear('return_date',$year)->get();
        return datatables()->of($data)->toJson();
    }
    public function year_datatable($year){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereYear('return_date',$year)->get();
        return datatables()->of($data)->toJson();
    }
    public function range_datatable($from,$to){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereBetween('return_date',[$from, $to])->get();
        return datatables()->of($data)->toJson();
    }

    public function report_all(){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')->get();
        return view('report.purchasereturn.reportpurchasereturn',compact('data'));
    }

    public function report_today(){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereRaw('Date(return_date) = CURDATE()')->get();;
        return view('report.purchasereturn.reportpurchasereturn',compact('data'));
    }
    public function report_month($month,$year){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereMonth('return_date',$month)->whereYear('return_date',$year)->get();
        return view('report.purchasereturn.reportpurchasereturn',compact('data'));
    }

    public function report_year($year){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereYear('return_date',$year)->get();
        return view('report.purchasereturn.reportpurchasereturn',compact('data'));
    }
    public function report_range($from,$to){
        $data = DB::table('transaksi_purchase_return')->join('tbl_suplier','tbl_suplier.id_suplier','=','transaksi_purchase_return.id_suplier')
        ->select('return_id','return_date','nama_suplier',DB::raw('sum(price) as price'))->groupBy('return_id','return_date','nama_suplier')
        ->whereBetween('return_date',[$from, $to])->get();
        return view('report.purchasereturn.reportpurchasereturn',compact('data'));
    }
}
