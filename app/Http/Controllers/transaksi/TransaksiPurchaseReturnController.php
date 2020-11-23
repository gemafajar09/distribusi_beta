<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPurchaseReturn;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class TransaksiPurchaseReturnController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_transaksi_purchase_return'=>'numeric',
            'return_id'=>'numeric',
            'return_date'=>'date',
            'id_suplier'=>'numeric',
            'note_return'=>'numeric',
            'jumlah_return'=>'numeric',
            'price'=>'numeric',
            'register'=>'numeric',
            'status'=>'numeric'
        );

        $this->dataisi = [];
        $this->datatable = [];
    }

    public function index(){
        return view('pages.transaksi.purchasetransaksi.purchase_return');
    }

    public function data($id){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder($id);
        $format = '%d,%s';
        $stok = [];
        $this->dataisi = [];
        foreach ($data as $d) {
            $id = $d->produk_id;
            $jumlah = $d->jumlah;
            $harga = $d->capital_price;
            $stok_id = $d->stok_id;
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
            
            $this->dataisi[] = ["stok"=>$stokquantity,"stok_id"=>$stok_id,"satuan_price"=>$harga];
        }
       
        // return datatables()->of($this->dataisi)->toJson();
    }

    public function join_builder($id){
        $data = DB::table('tbl_stok as tmp')
            ->where('produk_id',$id)
            ->select('jumlah','produk_id','capital_price','stok_id')
            ->get();
            return $data;
    }

    public function getStok($id){
        $run = $this->data($id);
        $data = $this->dataisi;
        return $data;
    }

    public function join_data_return(){
        $data = DB::table('transaksi_purchase_return as t')
                ->where('register','0')
                ->where('status','0')
                ->join('tbl_stok as s','s.stok_id','=','t.stok_id')
                ->join('tbl_produk as p','p.produk_id','=','s.produk_id')
                ->join('tbl_suplier as sp','sp.id_suplier','=','t.id_suplier')
                ->select('id_transaksi_purchase_return','jumlah_return','produk_nama','capital_price','nama_suplier','note_return','s.produk_id as produk_id','return_date','return_id','s.stok_id as stok_id')
                ->get();
            return $data;
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_data_return();
        $format = '%d %s | ';
        $stok = [];
        $this->datatable= [];
        foreach ($data as $d) {
            $id = $d->produk_id;
            $jumlah = $d->jumlah_return;
            $harga = $d->capital_price;
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
            $d->total = round($harga * $d->jumlah_return);
            $this->datatable[] = ["produk_id"=>$d->produk_id,"produk_nama"=>$d->produk_nama,"stok_quantity"=>$d->stok_quantity,"price"=>$d->total,"id_transaksi_purchase_return"=>$d->id_transaksi_purchase_return,"return_date"=>$d->return_date,"stok_id"=>$d->stok_id,"nama_suplier"=>$d->nama_suplier,"price"=>$d->total,"note_return"=>$d->note_return,"return_id"=>$d->return_id,"jumlah_return"=>$d->jumlah_return];   
        }
       
        return datatables()->of($this->datatable)->toJson();
    }

    public function add(Request $request)
    {
        // id_brand belum final
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
        } else {
            return response()->json(['id' => TransaksiPurchaseReturn::create($request->all())->id_transaksi_purchase_tmp, 'message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
        }
    } 

    public function register(){
        $data1 = $this->datatable();
        $datatmp =  $this->datatable;
        $update = DB::table('transaksi_purchase_return')->update(array('register' => '1'));
        foreach ($datatmp as $d) {
            $stok_id = $d['stok_id'];
            $jumlah = $d['jumlah_return'];
            $data = Stok::find($stok_id);
            $data->decrement('jumlah',$jumlah);
            $data->save();
        }
        return view('report.purchase_transaksi_return',compact('datatmp'));
    }

    public function remove(Request $request, $id){
        try{
            $data = TransaksiPurchaseReturn::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }
}
