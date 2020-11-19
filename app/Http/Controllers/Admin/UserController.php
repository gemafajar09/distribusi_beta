<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_user'=>'numeric',
            'nama_user'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'username'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'password'=>'required',
            'level'=>'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'telepon'=>'required|numeric',
            'email'=>'required|email',
            'id_cabang'=>'required|numeric',   
        );

        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'
                   
        );
    }

    public function index()
    {   
        $role = DB::table('tbl_role_user')
                ->select('id_role','nama_role')
                ->get();
        $cabang = DB::table('tbl_cabang')
                ->select('id_cabang','nama_cabang')
                ->get();
        return view("pages.admin.user.index",compact('cabang','role'));
    }

    public function datatable(){
        // untuk datatables Sistem Join Query Builder
        $data = $this->join_builder();
        return datatables()->of($data)->toJson();
    }

    public function join_builder($id=null){
        $data = DB::table('tbl_user')
                ->join('tbl_cabang','tbl_cabang.id_cabang','=','tbl_user.id_cabang')
                ->join('tbl_role_user','tbl_role_user.id_role','=','tbl_user.level')
                ->select('id_user','nama_user','username','password','level','nama_role','tbl_user.telepon as telepon','tbl_user.email as email','nama_cabang')
                ->get();
        return $data;
    }

    public function get(Request $request,$id=null)
    {
        try{
            if($id){
                $data = User::findOrFail($id);
            }else{
                $data = User::all();
            }
            return response()->json(['data'=>$data,'status'=>200]);
        }catch(ModelNotFoundException $e){
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }

    public function add(Request $request){
        $password = Hash::make($request->input('password'));
        $request->merge(['password' => $password]);
        $validator = Validator::make($request->all(),$this->rules,$this->messages);
        if($validator->fails()){
            return response()->json(['messageForm'=>$validator->errors(),'status'=>422,'message'=>'Data Tidak Valid']);
        }else{
            return response()->json(['id'=>User::create($request->all())->id_user,'message'=>'Data Berhasil Ditambahkan','status'=>200]);
        }
    }

    public function edit(Request $request){
        $id = $request->input('id_user');
        try{
            $edit = User::findOrFail($id);
            $validator = Validator::make($request->all(),$this->rules,$this->messages);
            if($validator->fails()){
                return response()->json(['messageForm'=>$validator->errors(),'status'=>422,'message'=>'Data Tidak Valid']);
            }else{
                $edit->nama_user = $request->input('nama_user');
                $edit->username = $request->input('username');
                $edit->password = $request->input('password');
                $edit->level = $request->input('level');
                $edit->telepon = $request->input('telepon');
                $edit->email = $request->input('email');
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
            $data = User::findOrFail($id);
            $data->delete();
            return response()->json(['message'=>'Data Berhasil Di Hapus','status'=>200]);
        }catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Data Tidak Ditemukan','status'=>404]);
        }
    }
}
