<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_produk'=>'numeric',
            'produk_type'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'id_brand'=>'required|numeric',
            'produk_nama'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'produk_harga'=>'required|numeric',
            'stok'=>'required|numeric',
            'id_satuan'=>'required|numeric'
        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'
                   
        );
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder();
        return datatables()->of($data)->toJson();
        
       
    }
    
    public function join_builder($id=null){
        // tempat join hanya menselect beberapa field tambahkan master brand
        $data = DB::table('tbl_produk')
                ->join('tbl_satuan','tbl_satuan.id_satuan','=','tbl_produk.id_satuan')
                ->join('tbl_brand','tbl_brand.id_brand','=','tbl_produk.id_brand')
                ->get();
        return $data;
    }

    public function get(Request $request,$id=null)
    {
        try{
            if($id){
                $data = Produk::findOrFail($id);
            }else{
                $data = Produk::all();
            }
            return response()->json(['data'=>$data,'status'=>200]);
        }catch(ModelNotFoundException $e){
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }

    public function add(Request $request){
        // id_brand belum final
        $validator = Validator::make($request->all(),$this->rules,$this->messages);
        if($validator->fails()){
            return response()->json(['messageForm'=>$validator->errors(),'status'=>422,'message'=>'Data Tidak Valid']);
        }else{
            return response()->json(['id'=>Produk::create($request->all())->produk_id,'message'=>'Data Berhasil Ditambahkan','status'=>200]);
        }
    }


    public function edit(Request $request){
        $id = $request->input('produk_id');
        try{
            $edit = Produk::findOrFail($id);
            $validator = Validator::make($request->all(),$this->rules,$this->messages);
            if($validator->fails()){
                return response()->json(['messageForm'=>$validator->errors(),'status'=>422,'message'=>'Data Tidak Valid']);
            }else{
                $edit->produk_type = $request->input('produk_type');
                $edit->id_brand = $request->input('id_brand');
                $edit->produk_nama = $request->input('produk_nama');
                $edit->produk_harga = $request->input('produk_harga');
                $edit->stok = $request->input('stok');
                $edit->id_satuan = $request->input('id_satuan');
                $edit->save();
                return response()->json(['message'=>'Data Berhasil Di Edit','data'=>$edit,'status'=>200]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }

    }

    public function remove(Request $request, $id){
        try{
            $data = Produk::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }



    

    
}
