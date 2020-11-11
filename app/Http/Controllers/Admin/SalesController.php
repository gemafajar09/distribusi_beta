<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Sales;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_sales' => 'numeric',
            'nama_sales' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'alamat' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'telepon' => 'required|numeric',
        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'

        );
    }

    public function index()
    {
        return view("pages.admin.sales.index");
    }

    public function datatable()
    {
        // untuk datatables Sistem Join Query Builder
        return datatables()->of(Sales::all())->toJson();
    }

    public function join_builder($id = null)
    {
        // tempat join hanya menselect beberapa field
    }

    public function get(Request $request, $id = null)
    {
        try {
            if ($id) {
                $data = Sales::findOrFail($id);
            } else {
                $data = Sales::all();
            }
            return response()->json(['data' => $data, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function add(Request $request)
    {
        // id_brand belum final
        $validator = Validator::make($request->all(), $this->rules, $this->messages);
        if ($validator->fails()) {
            return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
        } else {
            return response()->json(['id' => Sales::create($request->all())->id_sales, 'message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('id_sales');
        try {
            $edit = Sales::findOrFail($id);
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
            if ($validator->fails()) {
                return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
            } else {
                $edit->nama_sales = $request->input('nama_sales');
                $edit->alamat = $request->input('alamat');
                $edit->telepon = $request->input('telepon');
                $edit->save();
                return response()->json(['message' => 'Data Berhasil Di Edit', 'data' => $edit, 'status' => 200]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function remove(Request $request, $id)
    {
        try {
            $data = Sales::findOrFail($id);
            $data->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function getSales(){
            $data = Sales::all('id_sales','nama_sales');
            return response()->json(['data' => $data, 'status' => 200]);
    }
}
