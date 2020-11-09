<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Satuan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_satuan'=>'numeric',
            'nama_satuan'=>'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'keterangan_satuan'=>'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed',       
        );
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        return datatables()->of(Satuan::all())->toJson();
    }

    public function join_builder($id=null){
        // tempat join hanya menselect beberapa field
    }

    public function get(Request $request,$id=null)
    {
        try{
            if($id){
                $data = Satuan::findOrFail($id);
            }else{
                $data = Satuan::all();
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
            return response()->json(['messageForm'=>$validator->errors(),'status'=>422]);
        }else{
            return response()->json(['id'=>Satuan::create($request->all())->id_satuan,'message'=>'Data Berhasil Ditambahkan','status'=>200]);
        }
    }

    public function edit(Request $request){
        $id = $request->input('id_satuan');
        try{
            $edit = Satuan::findOrFail($id);
            $validator = Validator::make($request->all(),$this->rules,$this->messages);
            if($validator->fails()){
                return response()->json(['messageForm'=>$validator->errors(),'status'=>422]);
            }else{
                $edit->id_satuan = $request->input('id_satuan');
                $edit->nama_satuan = $request->input('nama_satuan');
                $edit->keterangan_satuan = $request->input('keterangan_satuan');
                $edit->save();
                return response()->json(['message'=>'Data Berhasil Di Edit','data'=>$edit,'status'=>200]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }

    }

    public function remove(Request $request, $id){
        try{
            $data = Satuan::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }
}
