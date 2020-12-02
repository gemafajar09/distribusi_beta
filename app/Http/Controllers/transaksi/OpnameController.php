<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Opname;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class OpnameController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_opname' => 'numeric',
            'stok_id' => 'numeric',
            'jumlah_fisik'=> 'numeric',
            'balance'=>'',
            'update_opname'=>'date'
            
        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'

        );
    }
    public function index(){
        return view('pages.transaksi.opname.index');
    }

    public function datatablesopname(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder();
        
        foreach ($data as $d) {
            $id = $d->produk_id;
            $jumlah = $d->jumlah;
            $selisih = abs($d->jumlah_fisik - $d->jumlah);
            $capital_price = $d->capital_price;
            $proses = DB::table('tbl_unit')->where('produk_id',$id)
                        ->join('tbl_satuan','tbl_unit.maximum_unit_name','=','tbl_satuan.id_satuan')
                        ->select('id_unit','nama_satuan as unit','default_value')
                        ->orderBy('id_unit','ASC')
                        ->get();
            
            $stokquantity = $this->convert($proses,$jumlah);
            $jumlah_stok = implode(" ",$stokquantity);
            $selisihquantity = $this->convert($proses,$selisih);
            $selisih_stok = implode(" ",$selisihquantity);
            $dataisi[] = ["produk_nama"=>$d->produk_nama,"capital_price"=>$capital_price,"jumlah"=>$jumlah_stok,"produk_id"=>$d->produk_id,"stok_id"=>$d->stok_id,"balance"=>$d->balance,"update_opname"=>$d->update_opname,"selisih"=>$selisih_stok];
        }
        return view('pages.transaksi.opname.table',compact('dataisi'));
        
    }

    public function convert($proses,$jumlah){
        $stokquantity=[];
        $hasilbagi=0;
        $format = '%d %s ';
        $stok = [];
        foreach ($proses as $index => $list) {
            $banyak =  sizeof($proses);
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

        return $stokquantity;
    }

    public function join_builder(){
        $cabang = session()->get('cabang');
        $data = DB::table('tbl_stok')
                ->join('tbl_produk','tbl_produk.produk_id','=','tbl_stok.produk_id')
                ->leftjoin('tbl_opname as o','o.stok_id','=','tbl_stok.stok_id')
                ->where('id_cabang',$cabang)
                ->select('tbl_stok.produk_id as produk_id','produk_nama','jumlah','capital_price','tbl_stok.stok_id as stok_id','balance','update_opname','jumlah_fisik')
                ->get();
         return $data;
        
    }

    public function cekbalance($fisik,$stok_id){
        $data = DB::table('tbl_stok')
                ->where('stok_id',$stok_id)
                ->get();
                $format = '%d %s ';
                $stok = [];
                $dataisi = [];
                foreach ($data as $d) {
                    $id = $d->produk_id;
                    $jumlah = abs($fisik-$d->jumlah);
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
                    $d->total_harga = $harga * $jumlah;
                    $dataisi[] = ["capital_price"=>$capital_price,"jumlah"=>$d->stok_quantity,"produk_id"=>$d->produk_id,"stok_id"=>$d->stok_id,"total_harga"=>$d->total_harga];
                }
            return response()->json(['data'=>$dataisi]);
    }

    
        public function add(Request $request)
    {
        $stok_id = $request->input('stok_id');
        $cek = DB::table('tbl_opname')->where('stok_id',$stok_id)->first();
        if(empty($cek)){
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
        } else {
            return response()->json(['id' => Opname::create($request->all())->id_opname, 'message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
            }
        }else{
            $jum_fisik = $request->input('jumlah_fisik');
            $status = $request->input('balance');
            $update_tanggal = $request->input('update_opname');
            $update = DB::table('tbl_opname')->where('stok_id',$stok_id)
                        ->update(['jumlah_fisik'=>$jum_fisik,'update_opname'=>$update_tanggal,'balance'=>$status]);
            return response()->json(['data'=>$update,'status'=>200]);
        }
    }


    public function print_faktur(){
        $data = DB::table('tbl_opname')
                ->leftJoin('tbl_stok','tbl_stok.stok_id','=','tbl_opname.stok_id')
                ->join('tbl_produk','tbl_stok.produk_id','=','tbl_produk.produk_id')
                ->select('produk_nama','tbl_produk.produk_id as produk_id','jumlah','capital_price','balance','update_opname','jumlah_fisik')
                ->get();
        foreach ($data as $d) {
            $jumlah = $d->jumlah;
            $jumlah_fisik = $d->jumlah_fisik;
            $selisih = abs($d->jumlah - $d->jumlah_fisik);
            $id = $d->produk_id;
            $proses = DB::table('tbl_unit')->where('produk_id',$id)
                                ->join('tbl_satuan','tbl_unit.maximum_unit_name','=','tbl_satuan.id_satuan')
                                ->select('id_unit','nama_satuan as unit','default_value')
                                ->orderBy('id_unit','ASC')
                                ->get();
            $jumlah = $this->convert($proses,$jumlah);
            $jumlah = implode(" ",$jumlah);
            $jumlah_fisik = $this->convert($proses,$jumlah_fisik);
            $jumlah_fisik = implode(" ",$jumlah_fisik);
            $selisih= $this->convert($proses,$selisih);
            $selisih = implode(" ",$selisih);

            $dataisi[] = ["produk_nama"=>$d->produk_nama,"capital_price"=>$d->capital_price,"jumlah"=>$jumlah,"balance"=>$d->balance,"update_opname"=>$d->update_opname,"selisih"=>$selisih,'jumlah_fisik'=>$jumlah_fisik];
        }

        return view('report.reportopname',compact(['dataisi']));
    }
    

}
