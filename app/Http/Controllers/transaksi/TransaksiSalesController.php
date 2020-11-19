<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\TransaksiSales;
use App\TransaksiSalesDetail;
use App\TransaksiSalesTmp;
use App\Models\Sales;
use App\Models\Customer;
use DB;

class TransaksiSalesController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_transaksi_sales' => 'numeric',
            'id_transaksi_detail' => 'numeric',
            'id_transaksi_tmp' => 'numeric',
            'sales_id' => 'numeric',
            'stok_id' => 'numeric',
            'qty_carton' => 'numeric',
            'qty_cup' => 'numeric',
            'qty_pcs' => 'numeric',
            'qty_bungkus' => 'numeric',
            'customer_id' => 'numeric',
            'invoice_id' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'transaksi_tipe' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/',
            'note' => 'required|regex:/(^[A-Za-z0-9 .]+$)+/',

        );
        $this->messages = array(
            'regex' => 'The Symbol Are Not Allowed'

        );
    }

    public function index()
    {
        $cabang = session()->get('cabang');
        $id = strlen(session()->get('id'));
        $inv = DB::table('transaksi_sales')->orderBy('id_transaksi_sales','desc')->first();
        if($id == 1)
        {
            $user = '00'.session()->get('id');
        }
        else if($id == 2)
        {
            $user = '0'.session()->get('id');
        }
        else if($id == 3)
        {
            $user = session()->get('id');
        }
        if($inv == NULL)
        {
            $invoice = 'TOVS-'.date('Ym')."-".$user.'-1';
        }else{
            $cekinv = substr($inv->invoice_id,16,50);
            $plus = (int)$cekinv + 1;
            $invoice = 'TOVS-'.date('Ym')."-".$user.'-'.$plus;
        }
        $data['invoice'] = $invoice;
        $data['salesid'] = Sales::getAll();
        $data['customerid'] = Customer::all();
        $data['stockid'] = DB::table('tbl_produk')
                            ->join('tbl_stok', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
                            ->where('tbl_stok.id_cabang',$cabang)
                            ->select('*')
                            ->get();
                            // dd($cabang);
                            // dd($data['stockid']);
        return view('pages.transaksi.salestransaksi.index',$data);
    }

    public function datatable()
    {
        return datatables()->of(TransaksiSales::all())->toJson();
    }

    public function get(Request $request, $id = null)
    {
        try {
            if ($id) {
                $data = TransaksiSales::findOrFail($id);
            } else {
                $data = TransaksiSales::all();
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
            return response()->json(['id' => TransaksiSales::create($request->all())->id_transaksi_sales, 'message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('id_cabang');
        try {
            $edit = Cabang::findOrFail($id);
            $validator = Validator::make($request->all(), $this->rules, $this->messages);
            if ($validator->fails()) {
                return response()->json(['messageForm' => $validator->errors(), 'status' => 422, 'message' => 'Data Tidak Valid']);
            } else {
                $edit->nama_cabang = $request->input('nama_cabang');
                $edit->alamat = $request->input('alamat');
                $edit->kode_cabang = $request->input('kode_cabang');
                $edit->telepon = $request->input('telepon');
                $edit->email = $request->input('email');
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
            $data = Cabang::findOrFail($id);
            $data->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function addkeranjang(Request $r)
    {
        $input = new TransaksiSalesTmp();
        $input->invoice_id = $r->invoiceid;
        $input->invoice_date = date('Y-m-d');
        $input->stok_id = $r->produkid;
        $input->qty = 0;
        $input->price = $r->prices;
        $jumlah = $r->count;
        if($jumlah == 1)
        {
            $input->unit1 = $r->jumlah1."-".$r->unit1;
        }else if($jumlah == 2){
            $input->unit1 = $r->jumlah1."-".$r->unit1;
            $input->unit2 = $r->jumlah2."-".$r->unit2;
        }else if($jumlah == 3){
            $input->unit1 = $r->jumlah1."-".$r->unit1;
            $input->unit2 = $r->jumlah2."-".$r->unit2;
            $input->unit3 = $r->jumlah3."-".$r->unit3;
        }
        $input->diskon = $r->disc;
        $input->save();
    }

    // api
    public function getSales(Request $r)
    {
        $data = Sales::findOrFail($r->sales_id);
        if($data == TRUE)
        {
            return response()->json(['data' => $data, 'status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
    
    public function getCustomer(Request $r)
    {
        $data = Customer::findOrFail($r->customer_id);
        if($data == TRUE)
        {
            return response()->json(['data' => $data, 'status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
    
    public function getProduk(Request $r)
    {
        $cab = $r->cabang;
        $id_produk = $r->produk_id;
        $data =  DB::table('tbl_produk')
                ->select('*')
                ->join('tbl_stok', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
                ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
                ->where('tbl_stok.produk_id',$id_produk)
                ->where('tbl_stok.id_cabang',$cab)
                ->first();
        if($data == TRUE)
        {
            return response()->json(['data' => $data, 'status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function cekstok(Request $r){
        $id = $r->produk_id;
        $data = DB::table('tbl_unit')
                ->where('tbl_unit.produk_id',$id)
                ->join('tbl_satuan','tbl_unit.maximum_unit_name','=','tbl_satuan.id_satuan')
                ->select('tbl_unit.id_unit','tbl_satuan.nama_satuan as unit','tbl_unit.default_value')
                ->orderBy('tbl_unit.id_unit','ASC')
                ->get();
        if($data == TRUE)
        {
            return response()->json(['data' => $data, 'status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }
} 
