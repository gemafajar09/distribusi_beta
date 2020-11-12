<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Suplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class SuplierController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_suplier' => 'numeric',
            'nama_suplier' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'nama_perusahaan' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'alamat' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'kota' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'negara' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'telepon' => 'required|numeric',
            'fax' => 'required|numeric',
            'bank' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'no_akun' => 'required|numeric',
            'nama_akun' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
            'note' => 'required|regex:/(^[A-Za-z0-9 .,]+$)+/',
        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'

        );
    }

    public function index()
    {
        return view("pages.admin.suplier.index");
    }

    public function datatable()
    {
        // untuk datatables Sistem Join Query Builder
        return datatables()->of(Suplier::all())->toJson();
    }

    public function join_builder($id = null)
    {
        // tempat join hanya menselect beberapa field
    }

    public function get(Request $request, $id = null)
    {
        try {
            if ($id) {
                $data = Suplier::findOrFail($id);
            } else {
                $data = Suplier::all();
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
            return response()->json(['id' => Suplier::create($request->all())->id_suplier, 'message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('id_suplier');
        try {
            $edit = Suplier::findOrFail($id);
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
            if ($validator->fails()) {
                return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
            } else {
                $edit->nama_suplier = $request->input('nama_suplier');
                $edit->nama_perusahaan = $request->input('nama_perusahaan');
                $edit->alamat = $request->input('alamat');
                $edit->kota = $request->input('kota');
                $edit->negara = $request->input('negara');
                $edit->telepon = $request->input('telepon');
                $edit->fax = $request->input('fax');
                $edit->bank = $request->input('bank');
                $edit->no_akun = $request->input('no_akun');
                $edit->nama_akun = $request->input('nama_akun');
                $edit->note = $request->input('note');
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
            $data = Suplier::findOrFail($id);
            $data->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
}
