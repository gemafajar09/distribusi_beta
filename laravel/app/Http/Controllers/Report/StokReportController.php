<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class StokReportController extends Controller
{
    public function __construct()
    {
        $dataisi = [];
    }
    public function index(){
        return view('report.stok.index');
    }

    

    public function report($id_cabang,$id_warehouse=null){
        if($id_warehouse == null){
            $tmp = $this->datatable($id_cabang);
            $data = $this->dataisi;
            return view('report.stok.reportstok',compact('data'));
        }else{
            $tmp = $this->datatable($id_cabang,$id_warehouse);
            $data = $this->dataisi;
            return view('report.stok.reportstok',compact('data'));
        }
        
    }

    public function datatable($id_cabang,$id_warehouse=null){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder($id_cabang,$id_warehouse);
        $format = '%d %s ';
        $stok = [];
        $this->dataisi = [];
        foreach ($data as $d) {
            $id = $d->produk_id;
            $jumlah = $d->jumlah;
            $capital_price = $d->capital_price;
            $harga = $d->capital_price;
            $proses = DB::table('tbl_unit')->where('produk_id',$id)
                        ->join('tbl_satuan','tbl_unit.maximum_unit_name','=','tbl_satuan.id_satuan')
                        ->select('id_unit','nama_satuan as unit','default_value')
                        ->orderBy('id_unit','ASC')
                        ->get();
            $hasilbagi=0;
            $stokquantity=[];
            foreach ($proses as $index => $list) {
                $banyak =  sizeof($proses);
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
            $d->total_harga = $harga * $d->jumlah;
            $this->dataisi[] = ["id_unit"=>$id,"produk_nama"=>$d->produk_nama,"capital_price"=>$capital_price,"stok_harga"=>$d->total_harga,"jumlah"=>$d->stok_quantity,"produk_harga"=>$d->produk_harga,"stok_id"=>$d->stok_id,"nama_cabang"=>$d->nama_gudang];
        }
       
        return datatables()->of($this->dataisi)->toJson();
        
    }
    public function join_builder($id_cabang,$id_warehouse=null){
        // tempat join hanya menselect beberapa field tambah join brand
        if($id_warehouse == null){
            $data = DB::table('tbl_stok')
            ->where('tbl_stok.id_cabang',$id_cabang)
            ->join('tbl_produk','tbl_stok.produk_id','=','tbl_produk.produk_id')
            ->leftjoin('tbl_gudang as c','c.id_gudang','=','tbl_stok.id_gudang')
            ->get();
            return $data;
        }else{
            $data = DB::table('tbl_stok')
            ->where('tbl_stok.id_gudang',$id_warehouse)
            ->join('tbl_produk','tbl_stok.produk_id','=','tbl_produk.produk_id')
            ->leftjoin('tbl_gudang as c','c.id_gudang','=','tbl_stok.id_gudang')
            ->get();
            return $data;
        }
        
    }
}