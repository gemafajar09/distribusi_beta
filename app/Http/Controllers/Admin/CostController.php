<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Cost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'cost_id'=>'numeric',
            'id_sales'=>'required|numeric',
            'tanggal'=>'required|date',
            'cost_nama'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'nominal'=>'required|numeric',
            'note'=>'required|regex:/(^[A-Za-z0-9 .,]+$)+/'
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
        $data = DB::table('tbl_cost')
                ->join('tbl_sales','tbl_sales.id_sales','=','tbl_cost.id_sales')
                ->get();
        return $data;
    }

    public function get(Request $request,$id=null)
    {
        try{
            if($id){
                $data = Cost::findOrFail($id);
            }else{
                $data = Cost::all();
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
            return response()->json(['id'=>Cost::create($request->all())->cost_id,'message'=>'Data Berhasil Ditambahkan','status'=>200]);
        }
    }

    public function edit(Request $request){
        $id = $request->input('cost_id');
        try{
            $edit = Cost::findOrFail($id);
            $validator = Validator::make($request->all(),$this->rules,$this->messages);
            if($validator->fails()){
                return response()->json(['messageForm'=>$validator->errors(),'status'=>422,'message'=>'Data Tidak Valid']);
            }else{
                $edit->id_sales = $request->input('id_sales');
                $edit->tanggal = $request->input('tanggal');
                $edit->cost_nama = $request->input('cost_nama');
                $edit->nominal = $request->input('nominal');
                $edit->note = $request->input('note');
                $edit->save();
                return response()->json(['message'=>'Data Berhasil Di Edit','data'=>$edit,'status'=>200]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }

    }

    public function remove(Request $request, $id){
        try{
            $data = Cost::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }
}
