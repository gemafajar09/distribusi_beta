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
use Session;

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
        return view('pages.transaksi.salestransaksi.index',$data);
    }

    public function addkeranjang(Request $r)
    {
        $cek = DB::table('transaksi_sales_tmps')
        ->where('invoice_id',$r->invoiceid)
        ->where('stok_id',$r->produkid)
        ->where('id_user',$r->id_user)
        ->first();
        
        $jumlah = $r->count;
        if($cek == TRUE)
        {
            if($jumlah == 1)
            {
                $stunit1 = explode('-',$cek->unit1);
                $inputunit1 = $r->jumlah1 + $stunit1[0]."-".$r->unit1;
                $input = DB::table('transaksi_sales_tmps')->where('id_transaksi_tmp',$cek->id_transaksi_tmp)->update(['unit1' => $inputunit1]);
            }else if($jumlah == 2){
                $stunit1 = explode('-',$cek->unit1);
                $stunit2 = explode('-',$cek->unit2);
                $inputunit1 = $r->jumlah1 + $stunit1[0]."-".$r->unit1;
                $inputunit2 = $r->jumlah2 + $stunit2[0]."-".$r->unit2;
                $input = DB::table('transaksi_sales_tmps')->where('id_transaksi_tmp',$cek->id_transaksi_tmp)->update(['unit1' => $inputunit1,'unit2' => $inputunit2]);
            }else if($jumlah == 3){
                $stunit1 = explode('-',$cek->unit1);
                $stunit2 = explode('-',$cek->unit2);
                $stunit3 = explode('-',$cek->unit3);
                $inputunit1 = $r->jumlah1 + $stunit1[0]."-".$r->unit1;
                $inputunit2 = $r->jumlah2 + $stunit2[0]."-".$r->unit2;
                $inputunit3 = $r->jumlah3 + $stunit3[0]."-".$r->unit3;
                $input = DB::table('transaksi_sales_tmps')->where('id_transaksi_tmp',$cek->id_transaksi_tmp)->update(['unit1' => $inputunit1,'unit2' => $inputunit2, 'unit3' => $inputunit3]);
            }
            $input->save();
            if ($input == TRUE) {
                return response()->json(['message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
            } else {
                return response()->json(['status' => 422, 'message' => 'Data Tidak Valid']);
            }
        }else{
            $input = new TransaksiSalesTmp();
            $input->invoice_id = $r->invoiceid;
            $input->invoice_date = date('Y-m-d');
            $input->stok_id = $r->produkid;
            $input->qty = 0;
            $input->price = $r->prices;
            if($r->jumlah1 == NULL)
                {
                    $jum1 = '';
                   
                }else{
                    $jum1 = $r->jumlah1.'-'.$r->unit1;
                    
                }
                if($r->jumlah2 == NULL)
                {
                    $jum2 = '';
                }else{
                    $jum2 = $r->jumlah2.'-'.$r->unit2;
                }
                if($r->jumlah3 == NULL)
                {
                    $jum3 = '';
                }else{
                    $jum3 = $r->jumlah3.'-'.$r->unit3;
                }
            if($jumlah == 1)
            {
                $input->unit1 = $jum1;
            }else if($jumlah == 2){
                
                $input->unit1 = $jum1;
                $input->unit2 = $jum2;
            }else if($jumlah == 3){
                
                $input->unit1 = $jum1;
                $input->unit2 = $jum2;
                $input->unit3 = $jum3;
            }
            $input->diskon = $r->amount;
            $input->id_user = $r->id_user;
            $input->save();
            if ($input == TRUE) {
                return response()->json(['message' => 'Data Berhasil Ditambahkan', 'status' => 200]);
            } else {
                return response()->json(['status' => 422, 'message' => 'Data Tidak Valid']);
            }
        }
        
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

    public function hargakusus(Request $r)
    {
        $id_produk = $r->id_stok;
        $id_customer = $r->customer;
        $data = DB::table('tbl_harga_khusus')
                ->where('id_customer',$id_customer)
                ->where('produk_id',$id_produk)
                ->select('spesial_nominal')
                ->first();
        if($data == TRUE)
        {
            return response()->json(['data' => $data, 'status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function cekstok(Request $r)
    {
        $id = $r->produk_id;
        $data = DB::table('tbl_unit')
                ->where('tbl_unit.produk_id',$id)
                ->join('tbl_satuan','tbl_unit.minimum_unit_name','=','tbl_satuan.id_satuan')
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

    public function datatablessales(Request $r)
    {
        $id = Session()->get('id');
        $date = date('Y-m-d');
        $data = DB::table('transaksi_sales_tmps')
                ->join('tbl_stok','tbl_stok.stok_id','transaksi_sales_tmps.stok_id')
                ->join('tbl_produk', 'tbl_produk.produk_id','tbl_stok.produk_id')
                ->join('tbl_type_produk', 'tbl_produk.id_type_produk','tbl_type_produk.id_type_produk')
                ->select('tbl_produk.produk_id','tbl_produk.produk_brand','tbl_produk.produk_nama','tbl_produk.produk_harga','price','transaksi_sales_tmps.*','tbl_type_produk.nama_type_produk','tbl_stok.stok_id')
                ->where('transaksi_sales_tmps.id_user',$id)
                ->where('transaksi_sales_tmps.invoice_date',$date)
                ->get();
        $init = [];
        foreach($data as $a)
        {
            // pecah data unit
            if($a->unit1 != NULL)
            {
                $pecah1 = explode('-',$a->unit1);
                $jumlah1 = $pecah1[0];
                $satuan1 = $pecah1[1];
                $uang1 = $a->price;
                // cek satuan
                $nilaisisa1 = 0;
                $nilaikonversi1 = $jumlah1;
                
            }else{
                $nilaisisa1 = 0;
                $nilaikonversi1 = 0;
                $satuan1 = '';
                $uang1 = 0;
            }
            // pecah data unit
            if($a->unit2 != NULL)
            {
                $pecah2 = explode('-',$a->unit2);
                $jumlah2 = $pecah2[0];
                $satuan2 = $pecah2[1];
                // cek satuan
                $unit2 = DB::table('tbl_unit')
                        ->join('tbl_satuan','tbl_satuan.id_satuan','tbl_unit.minimum_unit_name')    
                        ->where('tbl_unit.produk_id',$a->produk_id)
                        ->where('tbl_satuan.nama_satuan',$satuan2)
                        ->first();
                $nilaisisa2 = $jumlah2 % $unit2->default_value;
                $nilaikonversi2 = ($jumlah2 - $nilaisisa2) / $unit2->default_value;
                $uang2 = $a->price / $unit2->default_value;
            }else{
                $nilaisisa2 = 0;
                $nilaikonversi2 = 0;
                $satuan2 = '';
                $uang2 = 0;
            }
            // pecah data unit
            if($a->unit3 != NULL)
            {
                $pecah3 = explode('-',$a->unit3);
                $jumlah3 = $pecah3[0];
                $satuan3 = $pecah3[1];
                // cek satuan
                $unit3 = DB::table('tbl_unit')
                        ->join('tbl_satuan','tbl_satuan.id_satuan','tbl_unit.minimum_unit_name')    
                        ->where('tbl_unit.produk_id',$a->produk_id)
                        ->where('tbl_satuan.nama_satuan',$satuan3)
                        ->first();
                $nilaisisa3 = $jumlah3 % $unit3->default_value;
                $nilaikonversi3 = ($jumlah3 - $nilaisisa2) / $unit3->default_value;
                $uang3 = $a->price / $unit3->default_value;
            }else{
                $nilaisisa3 = 0;
                $nilaikonversi3 = 0;
                $satuan3 = '';
                $uang3 = 0;
            }

            $quantity1 =  ($nilaikonversi1 + $nilaikonversi2)." ".$satuan1." | ";
            $quantity2 =  ($nilaisisa1 + $nilaisisa2 + $nilaikonversi3)." ".$satuan2." | ";
            $quantity3 =  ($nilaisisa3)." ".$satuan3." | ";
            $total = (($nilaikonversi1 + $nilaikonversi2)*$uang1) + (($nilaisisa1 + $nilaisisa2 + $nilaikonversi3)*$uang2) + (($nilaisisa3)*$uang3);
            if($quantity1 != 0){ $qty1 = $quantity1; }else{ $qty1 = '';}
            if($quantity2 != 0){ $qty2 = $quantity2; }else{ $qty2 = '';}
            if($quantity3 != 0){ $qty3 = $quantity3; }else{ $qty3 = '';}
            $init[] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'produk_harga' => number_format($a->price),
                'quantity' => $qty1.$qty2.$qty3,
                'total' => number_format($total),
                'diskon' => number_format($a->diskon * $jumlah1),
                'tot' => $total,
                'amount' => $total - ($a->diskon * $jumlah1),
                'id_transaksi_tmp' => $a->id_transaksi_tmp
            );
        }
        return view('pages.transaksi.salestransaksi.table',compact('init'));
    }

    public function deleteitem(Request $r)
    {
        $delete = DB::table('transaksi_sales_tmps')->where('id_transaksi_tmp',$r->id_transksi)->delete();
        if($delete == TRUE)
        {
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function rekaptransaksi(Request $r)
    {
        $input = new TransaksiSales();
        $input->sales_type = $r->salestype;
        $input->invoice_id = $r->invoiceid;
        $input->invoice_date = $r->invoicedate;
        $input->transaksi_tipe = $r->radiocash;
        $input->term_until = $r->term_util;
        $input->sales_id = $r->salesmanid;
        $input->customer_id = $r->customerid;
        $input->note = $r->note;
        $input->totalsales = $r->totalsales;
        $input->diskon = $r->discon;
        $input->id_user = $r->id_user;
        $input->save();

        $id_user = $r->id_user;
        $data = DB::table('transaksi_sales_tmps')->where('invoice_id',$r->invoiceid)->where('id_user',$id_user)->get();
        foreach($data as $a)
        {
            $insert = new TransaksiSalesDetail();
            $insert->invoice_id = $a->invoice_id;
            $insert->invoice_date = $a->invoice_date;
            $insert->stok_id = $a->stok_id;
            $insert->qty = $a->qty;
            $insert->price = $a->price;
            $insert->unit1 = $a->unit1;
            $insert->unit2 = $a->unit2;
            $insert->unit3 = $a->unit3;
            $insert->diskon = $a->diskon;
            $insert->id_user = $a->id_user;
            $insert->save();

            DB::table('transaksi_sales_tmps')->where('id_transaksi_tmp',$a->id_transaksi_tmp)->delete();
        }
        if($input == TRUE)
        {
            return response()->json(['status' => 200, 'invoice_id' => $r->invoiceid]);
        }else{
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function faktur($id)
    {
        $data = DB::table('transaksi_sales_details')
                ->join('tbl_stok','tbl_stok.stok_id','transaksi_sales_details.stok_id')
                ->join('tbl_produk', 'tbl_produk.produk_id','tbl_stok.produk_id')
                ->join('tbl_type_produk', 'tbl_produk.id_type_produk','tbl_type_produk.id_type_produk')
                ->select('tbl_produk.produk_id','tbl_produk.produk_brand','tbl_produk.produk_nama','tbl_produk.produk_harga','price','transaksi_sales_details.*','tbl_type_produk.nama_type_produk','tbl_stok.stok_id')
                ->where('transaksi_sales_details.invoice_id',$id)
                ->get();
        foreach($data as $a)
        {
            // pecah data unit
            if($a->unit1 != NULL)
            {
                $pecah1 = explode('-',$a->unit1);
                $jumlah1 = $pecah1[0];
                $satuan1 = $pecah1[1];
                $uang1 = $a->price;
                // cek satuan
                $nilaisisa1 = 0;
                $nilaikonversi1 = $jumlah1;
                
            }else{
                $nilaisisa1 = 0;
                $nilaikonversi1 = 0;
                $satuan1 = '';
                $uang1 = 0;
            }
            // pecah data unit
            if($a->unit2 != NULL)
            {
                $pecah2 = explode('-',$a->unit2);
                $jumlah2 = $pecah2[0];
                $satuan2 = $pecah2[1];
                // cek satuan
                $unit2 = DB::table('tbl_unit')
                        ->join('tbl_satuan','tbl_satuan.id_satuan','tbl_unit.minimum_unit_name')    
                        ->where('tbl_unit.produk_id',$a->produk_id)
                        ->where('tbl_satuan.nama_satuan',$satuan2)
                        ->first();
                $nilaisisa2 = $jumlah2 % $unit2->default_value;
                $nilaikonversi2 = ($jumlah2 - $nilaisisa2) / $unit2->default_value;
                $uang2 = $a->price / $unit2->default_value;
            }else{
                $nilaisisa2 = 0;
                $nilaikonversi2 = 0;
                $satuan2 = '';
                $uang2 = 0;
            }
            // pecah data unit
            if($a->unit3 != NULL)
            {
                $pecah3 = explode('-',$a->unit3);
                $jumlah3 = $pecah3[0];
                $satuan3 = $pecah3[1];
                // cek satuan
                $unit3 = DB::table('tbl_unit')
                        ->join('tbl_satuan','tbl_satuan.id_satuan','tbl_unit.minimum_unit_name')    
                        ->where('tbl_unit.produk_id',$a->produk_id)
                        ->where('tbl_satuan.nama_satuan',$satuan3)
                        ->first();
                $nilaisisa3 = $jumlah3 % $unit3->default_value;
                $nilaikonversi3 = ($jumlah3 - $nilaisisa2) / $unit3->default_value;
                $uang3 = $a->price / $unit3->default_value;
            }else{
                $nilaisisa3 = 0;
                $nilaikonversi3 = 0;
                $satuan3 = '';
                $uang3 = 0;
            }

            $quantity1 =  ($nilaikonversi1 + $nilaikonversi2)." ".$satuan1." | ";
            $quantity2 =  ($nilaisisa1 + $nilaisisa2 + $nilaikonversi3)." ".$satuan2." | ";
            $quantity3 =  ($nilaisisa3)." ".$satuan3." | ";
            $total = (($nilaikonversi1 + $nilaikonversi2)*$uang1) + (($nilaisisa1 + $nilaisisa2 + $nilaikonversi3)*$uang2) + (($nilaisisa3)*$uang3);
            if($quantity1 != 0){ $qty1 = $quantity1; }else{ $qty1 = '';}
            if($quantity2 != 0){ $qty2 = $quantity2; }else{ $qty2 = '';}
            if($quantity3 != 0){ $qty3 = $quantity3; }else{ $qty3 = '';}
            $datas['init'][] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'produk_harga' => number_format($a->price),
                'quantity' => $qty1.$qty2.$qty3,
                'total' => number_format($total),
                'diskon' => number_format($a->diskon * $jumlah1),
                'tot' => $total,
                'amount' => $total - ($a->diskon * $jumlah1),
                'id_transaksi_detail' => $a->id_transaksi_detail
            );
        }
        $datas['sales'] = DB::table('transaksi_sales')
        ->join('tbl_sales','tbl_sales.id_sales','transaksi_sales.sales_id')
        ->join('tbl_customer','tbl_customer.id_customer','transaksi_sales.customer_id')
        ->select('transaksi_sales.*','transaksi_sales.note as catatan','tbl_sales.*','tbl_customer.*')
        ->where('transaksi_sales.invoice_id',$id)
        ->first();
        $datas['inv'] = $id;
        return view("pages.transaksi.salestransaksi.faktur",$datas);
    }
} 
