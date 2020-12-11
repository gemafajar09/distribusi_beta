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
            'produk_id'=>'required',
            'id_type_produk'=>'required|numeric',
            'produk_brand'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'produk_nama'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'produk_harga'=>'required|numeric',
            'stok'=>'required|numeric',
            
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
                ->join('tbl_type_produk','tbl_type_produk.id_type_produk','=','tbl_produk.id_type_produk')
                ->get();
        return $data;
    }

    public function index(){
        return view('pages.admin.produk.index');
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
        // buat kode produk
        
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
                $edit->id_type_produk = $request->input('id_type_produk');
                $edit->produk_brand = $request->input('produk_brand');
                $edit->produk_nama = $request->input('produk_nama');
                $edit->produk_harga = $request->input('produk_harga');
                $edit->stok = $request->input('stok');
                
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
