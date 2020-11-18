<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPurchaseTmp;
use App\Models\TransaksiPurchase;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class TransaksiPurchaseController extends Controller
{
   public function index(){
       return view('pages.transaksi.purchasetransaksi.index');
   }
   public function register(){
        $data = TransaksiPurchaseTmp::all('invoice_id','invoice_date','transaksi_tipe','term_until','id_suplier','produk_id','quantity','unit_satuan_price','diskon','total_price','id_cabang')->toArray();
        // $tambah = TransaksiPurchase::insert($data);
        foreach ($data as $d) {
            $id = $d['produk_id'];
            $jumlah = $d['quantity'];
            $id_cabang = $d['id_cabang'];
            $cek = Stok::where('produk_id',$id)->first();
            if($cek){
                $edit = Stok::where('produk_id',$id)
                        ->increment('jumlah',$jumlah);
            }else{
                $stok = new Stok;
                $stok->produk_id = $id;
                $stok->jumlah = $jumlah;
                $stok->id_cabang = $id_cabang;
                $stok->save();
            }
        }
        $delete = TransaksiPurchaseTmp::truncate();
        $backurl = route('purchase_order');
        if($delete){
            return response()->json(['message'=>'Register Transaksi Berhasil','status'=>200]);
        }else{
            return response()->json(['message'=>'Register Transaksi Gagal','status'=>404]);
        }
        
    }
}
