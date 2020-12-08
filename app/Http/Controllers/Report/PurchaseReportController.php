<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransaksiPurchase;
use Illuminate\Support\Facades\DB;
class PurchaseReportController extends Controller
{
    public function index(){
        return view('report.purchase.index');
    }
    public function conversi($data){
        $dataisi = [];
        foreach ($data as $d) {
            if($d->transaksi_tipe == 0){
                $tipe = "CASH";
            }else{
                $tipe = "CREDIT";
            }
            if($d->sisa == 0){
                $status = "Lunas";
            }else{
                $status = "Belum Lunas";
            }
            $dataisi[] = ["invoice_id"=>$d->invoice_id,"invoice_date"=>$d->invoice_date,"transaksi_tipe"=>$tipe,"total"=>$d->total,"diskon"=>$d->diskon,"bayar"=>$d->bayar,"sisa"=>$d->sisa,"status"=>$status]; 
        }
        return $dataisi;
    }

    public function all_datatable(){
        $data = TransaksiPurchase::all();
        $dataisi = $this->conversi($data);
        return datatables()->of($dataisi)->toJson();
    }

    public function today_datatable(){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereRaw('Date(invoice_date) = CURDATE()')->get();;
        $dataisi = $this->conversi($data);
        return datatables()->of($dataisi)->toJson();
    }

    public function month_datatable($month,$year){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereMonth('invoice_date',$month)->whereYear('invoice_date',$year)->get();
        $dataisi = $this->conversi($data);
        return datatables()->of($dataisi)->toJson();
    }
    public function year_datatable($year){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereYear('invoice_date',$year)->get();
        $dataisi = $this->conversi($data);
        return datatables()->of($dataisi)->toJson();
    }
    public function range_datatable($from,$to){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereBetween('invoice_date',[$from, $to])->get();
        $dataisi = $this->conversi($data);
        return datatables()->of($dataisi)->toJson();
    }

    public function report_all(){
        $data = TransaksiPurchase::all();
        $dataisi = $this->conversi($data);
        return view('report.purchase.reportpurchase',compact('dataisi'));
    }

    public function report_today(){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereRaw('Date(invoice_date) = CURDATE()')->get();;
        $dataisi = $this->conversi($data);
        return view('report.purchase.reportpurchase',compact('dataisi'));
    }
    public function report_month($month,$year){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereMonth('invoice_date',$month)->whereYear('invoice_date',$year)->get();
        $dataisi = $this->conversi($data);
        return view('report.purchase.reportpurchase',compact('dataisi'));
    }

    public function report_year($year){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereYear('invoice_date',$year)->get();
        $dataisi = $this->conversi($data);
        return view('report.purchase.reportpurchase',compact('dataisi'));
    }
    public function report_range($from,$to){
        $data = DB::table('transaksi_purchase')->select(DB::raw('*'))
        ->whereBetween('invoice_date',[$from, $to])->get();
        $dataisi = $this->conversi($data);
        return view('report.purchase.reportpurchase',compact('dataisi'));
    }
    
}
