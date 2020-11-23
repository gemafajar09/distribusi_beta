<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPurchaseTmp;
use App\Models\TransaksiPurchase;
use App\Models\TransaksiPurchaseDetail;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class TransaksiPurchaseDetailController extends Controller
{
    public function __construct()
    {
        $this->dataisi = [];
    }
    public function index(){
        return view('pages.transaksi.purchasetransaksi.aproval');
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder();
        $format = '%d %s | ';
        $stok = [];
        $this->dataisi = [];
        foreach ($data as $d) {
            $id = $d->produk_id;
            $jumlah = $d->quantity;
            $harga = $d->unit_satuan_price;
            $proses = DB::table('tbl_unit')->where('produk_id',$id)
            ->join('tbl_satuan','tbl_unit.maximum_unit_name','=','tbl_satuan.id_satuan')
            ->select('id_unit','nama_satuan as unit','default_value')
            ->orderBy('id_unit','ASC')
            ->get();
            $hasilbagi=0;
            foreach ($proses as $index => $list) {
                $banyak = sizeof($proses);
                if($index == 0 ){
                $sisa = $jumlah % $list->default_value;
                $hasilbagi = ($jumlah-$sisa)/$list->default_value;
                $satuan[$index] = $list->unit;
                $lebih[$index] = $sisa;
                $harga = $harga / $list->default_value;
                if ($sisa > 0){
                    $stok[$index] = sprintf($format, $sisa, $list->unit);
                }
                 if($banyak == $index+1){
                    $satuan = array();
                    $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                    $stokquantity = array_values($stok);
                    $stok = array();
                }
                }else if($index == 1){
                    $sisa = $hasilbagi % $list->default_value;
                    $hasilbagi = ($hasilbagi-$sisa)/$list->default_value;
                    $satuan[$index] = $list->unit;
                    $lebih[$index] = $sisa;
                    $harga = $harga / $list->default_value;
                    if($sisa > 0){
                        $stok[$index-1] = sprintf($format, $sisa+$lebih[$index-1], $satuan[$index-1]);
                    }
                    if($banyak == $index+1){
                        $satuan = array();
                        $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                        $stokquantity = array_values($stok);
                        $stok = array();
                    }
                }else if($index == 2){
                    $sisa = $hasilbagi % $list->default_value;
                    $hasilbagi = ($hasilbagi-$sisa)/$list->default_value;
                    $satuan[$index] = $list->unit;
                    $lebih[$index] = $sisa;
                    $harga = $harga / $list->default_value;
                    if($sisa > 0){
                        $stok[$index-1] = sprintf($format, $sisa,  $satuan[$index-1]);
                    }
                    if($banyak == $index+1){
                        $satuan = array();
                        $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
                        $stokquantity = array_values($stok);
                        $stok = array();
                    }
                }    
            }
            $jumlah_stok = implode(" ",$stokquantity);
            $d->stok_quantity = $jumlah_stok;
            $d->total = round($harga * $d->quantity);
            $this->dataisi[] = ["produk_id"=>$d->produk_id,"nama_type_produk"=>$d->nama_type_produk,"produk_brand"=>$d->produk_brand,"produk_nama"=>$d->produk_nama,"unit_satuan_price"=>$d->unit_satuan_price,"stok_quantity"=>$d->stok_quantity,"diskon"=>$d->diskon,"total_price"=>$d->total_price,"total"=>$d->total,"id_transaksi_purchase_detail"=>$d->id_transaksi_purchase_detail,"invoice_id"=>$d->invoice_id,"invoice_date"=>$d->invoice_date,"transaksi_tipe"=>$d->transaksi_tipe];   
        }
       
        return datatables()->of($this->dataisi)->toJson();
    }

    public function join_builder($status='0'){
        $data = DB::table('transaksi_purchase_detail as tmp')
            ->where('status',$status)
            ->join('tbl_produk as a','a.produk_id','=','tmp.produk_id')
            ->join('tbl_type_produk as b','b.id_type_produk','=','a.id_type_produk')
            ->select('id_transaksi_purchase_detail','invoice_id','invoice_date','transaksi_tipe','tmp.produk_id as produk_id','nama_type_produk','produk_brand','produk_nama','unit_satuan_price','quantity','diskon','total_price','status')
            ->get();
            return $data;
    }

    public function approvalPurchase(Request $request){
       $id = $request->input('id');
       $status = $request->input('status');
       $update = TransaksiPurchaseDetail::find($id);
       $update1 = TransaksiPurchase::find($id);
       $produk_id = $update->produk_id;
       $jumlah = $update->quantity;
       $capital_price = $update->unit_satuan_price;
       $id_cabang = $update->id_cabang;
       if($status == 1){
           $update1->status = $status;
           $update->status = $status;
           $update1->save();
           $update->save();
           $cek = Stok::where('produk_id',$produk_id)->first();
           if($cek){
            $edit = Stok::where('produk_id',$produk_id)
                    ->increment('jumlah',$jumlah);
        }else{
            $stok = new Stok;
            $stok->produk_id = $produk_id;
            $stok->jumlah = $jumlah;
            $stok->id_cabang = $id_cabang;
            $stok->capital_price = $capital_price;
            $stok->save();
        }
           return response()->json(['message'=>'Data Di Approval','status'=>200]);
       }else{
            $update1->status = $status;
            $update->status = '2';
            $update->save();
            $update1->save();
           return response()->json(['message'=>'Data Tidak DiApproval','status'=>402]);
       }

    }
}
