<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class StokController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'stok_id'=>'numeric',
            'produk_id'=>'required|numeric',
            'jumlah'=>'required|numeric',
            'id_cabang'=>'required|numeric',
        );
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder();
        return datatables()->of($data)->toJson();
        
    }

    public function join_builder($id=null){
        // tempat join hanya menselect beberapa field tambah join brand
        $data = DB::table('tbl_stok')
                ->join('tbl_cabang','tbl_stok.id_cabang','=','tbl_cabang.id_cabang')
                ->join('tbl_produk','tbl_stok.produk_id','=','tbl_produk.produk_id')
                ->join('tbl_satuan','tbl_produk.id_satuan','=','tbl_satuan.id_satuan')
                ->join('tbl_brand','tbl_produk.id_brand','=','tbl_brand.id_brand')
                ->get();
        return $data;
    }

    public function get(Request $request,$id=null)
    {
        try{
            if($id){
                $data = Stok::findOrFail($id);
            }else{
                $data = Stok::all();
            }
            return response()->json(['data'=>$data,'status'=>200]);
        }catch(ModelNotFoundException $e){
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }

    public function add(Request $request){
        // id_brand belum final
        $validator = Validator::make($request->all(),$this->rules);
        if($validator->fails()){
            return response()->json(['messageForm'=>$validator->errors(),'status'=>422]);
        }else{
            return response()->json(['id'=>Stok::create($request->all())->stok_id,'message'=>'Data Berhasil Ditambahkan','status'=>200]);
        }
    }
    
    public function edit(Request $request){
        $id = $request->input('stok_id');
        try{
            $edit = Stok::findOrFail($id);
            $validator = Validator::make($request->all(),$this->rules);
            if($validator->fails()){
                return response()->json(['messageForm'=>$validator->errors(),'status'=>422]);
            }else{
                $edit->produk_id = $request->input('produk_id');
                $edit->jumlah = $request->input('jumlah');
                $edit->id_cabang = $request->input('id_cabang');
                $edit->save();
                return response()->json(['message'=>'Data Berhasil Di Edit','data'=>$edit,'status'=>200]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }

    }

    public function remove(Request $request, $id){
        try{
            $data = Stok::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }
}
