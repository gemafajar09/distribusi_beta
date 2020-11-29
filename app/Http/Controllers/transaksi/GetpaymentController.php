<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TransaksiSales;
use App\Getpayment;
use DB;

class GetpaymentController extends Controller
{
    public function index()
    {
        return view('pages.transaksi.getpayment.index');
    }

    public function getcredit(Request $r)
    {
        $ids = $r->id_transkasi;
        $inv = DB::table('tbl_getpayment')->orderBy('id_getpayment','desc')->first();

        if($inv == NULL)
        {
            $invoice = 'CC-'.date('Ym')."-".date('H')."-1";
        }else{
            $cekinv = substr($inv->invoice_id,13,50);
            $plus = (int)$cekinv + 1;
            $invoice = 'CC-'.date('Ym')."-".date('H').'-'.$plus;
        }
        $data = DB::table('transaksi_sales')
                    ->join('tbl_customer','tbl_customer.id_customer','transaksi_sales.customer_id')
                    ->where('transaksi_sales.invoice_id',$ids)
                    ->first();
                    if($data == TRUE)
                    {
                        return response()->json(['status' => 200, 'data' => $data, 'invoice' => $invoice]);
                    }else{
                        return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
                    }
    }

    public function caricustomer(Request $r)
    {
        $datas = DB::table('transaksi_sales')
            ->join('tbl_customer', 'tbl_customer.id_customer', 'transaksi_sales.customer_id')
            ->join('tbl_sales', 'tbl_sales.id_sales', 'transaksi_sales.sales_id')
            ->where('transaksi_sales.transaksi_tipe', 'Credit')
            ->where('tbl_customer.nama_customer','Like','%'.$r->nama.'%')
            ->get();
            // dd($datas);

        if($datas == TRUE)
        {
            $data['hasil'] = [];
            foreach($datas as $a)
            {
                $cek = DB::table('tbl_getpayment')->where('invoice_id',$a->invoice_id)->first();
                
                if($cek == TRUE)
                {
                    $payment = $cek->payment;
                    $sisa = $a->totalsales - $cek->payment;
                }else{
                    $payment = 0;
                    $sisa = $a->totalsales - 0;
                }
                $data['hasil'][] = array(
                    'invoice_id' => $a->invoice_id,
                    'invoice_date' => $a->invoice_date,
                    'nama_customer' => $a->nama_customer,
                    'nama_sales' => $a->nama_sales,
                    'totalsales' => $a->totalsales,
                    'payment' => $payment,
                    'remaining' => $sisa,
                    'term_until' => $a->term_until,
                    'status' => $a->status
                );
            }
        }else{
            $data['hasil'] = array(
                'invoice_id' => '',
                'invoice_date' => '',
                'nama_customer' => '',
                'nama_sales' => '',
                'totalsales' => '',
                'payment' => '',
                'remaining' => '',
                'term_until' => '',
                'status' => ''
            );
        }
        return view('pages.transaksi.getpayment.tabelpayment', $data);
    }

    public function detailtrans(Request $r)
    {
        $invoices = $r->id_transaksi;
        
        $data = DB::table('transaksi_sales_details')
            ->join('tbl_stok', 'tbl_stok.stok_id', 'transaksi_sales_details.stok_id')
            ->join('tbl_produk', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
            ->select('tbl_produk.produk_id', 'tbl_produk.produk_brand', 'tbl_produk.produk_nama', 'tbl_produk.produk_harga', 'price', 'transaksi_sales_details.*', 'tbl_type_produk.nama_type_produk', 'tbl_stok.stok_id')
            ->where('transaksi_sales_details.invoice_id', $invoices)
            ->get();
        $detail = [];
        foreach ($data as $a) {
            // pecah data unit
            if ($a->unit1 != NULL) {
                $pecah1 = explode('-', $a->unit1);
                $jumlah1 = $pecah1[0];
                $satuan1 = $pecah1[1];
                $uang1 = $a->price;
                // cek satuan
                $nilaisisa1 = 0;
                $nilaikonversi1 = $jumlah1;
            } else {
                $nilaisisa1 = 0;
                $nilaikonversi1 = 0;
                $satuan1 = '';
                $uang1 = 0;
            }
            // pecah data unit
            if ($a->unit2 != NULL) {
                $pecah2 = explode('-', $a->unit2);
                $jumlah2 = $pecah2[0];
                $satuan2 = $pecah2[1];
                // cek satuan
                $unit2 = DB::table('tbl_unit')
                    ->join('tbl_satuan', 'tbl_satuan.id_satuan', 'tbl_unit.minimum_unit_name')
                    ->where('tbl_unit.produk_id', $a->produk_id)
                    ->where('tbl_satuan.nama_satuan', $satuan2)
                    ->first();
                $nilaisisa2 = $jumlah2 % $unit2->default_value;
                $nilaikonversi2 = ($jumlah2 - $nilaisisa2) / $unit2->default_value;
                $uang2 = $a->price / $unit2->default_value;
            } else {
                $nilaisisa2 = 0;
                $nilaikonversi2 = 0;
                $satuan2 = '';
                $uang2 = 0;
            }
            // pecah data unit
            if ($a->unit3 != NULL) {
                $pecah3 = explode('-', $a->unit3);
                $jumlah3 = $pecah3[0];
                $satuan3 = $pecah3[1];
                // cek satuan
                $unit3 = DB::table('tbl_unit')
                    ->join('tbl_satuan', 'tbl_satuan.id_satuan', 'tbl_unit.minimum_unit_name')
                    ->where('tbl_unit.produk_id', $a->produk_id)
                    ->where('tbl_satuan.nama_satuan', $satuan3)
                    ->first();
                $nilaisisa3 = $jumlah3 % $unit3->default_value;
                $nilaikonversi3 = ($jumlah3 - $nilaisisa2) / $unit3->default_value;
                $uang3 = $a->price / $unit3->default_value;
            } else {
                $nilaisisa3 = 0;
                $nilaikonversi3 = 0;
                $satuan3 = '';
                $uang3 = 0;
            }

            $quantity1 =  ($nilaikonversi1 + $nilaikonversi2) . " " . $satuan1 . " | ";
            $quantity2 =  ($nilaisisa1 + $nilaisisa2 + $nilaikonversi3) . " " . $satuan2 . " | ";
            $quantity3 =  ($nilaisisa3) . " " . $satuan3 . " | ";
            $total = (($nilaikonversi1 + $nilaikonversi2) * $uang1) + (($nilaisisa1 + $nilaisisa2 + $nilaikonversi3) * $uang2) + (($nilaisisa3) * $uang3);
            if ($quantity1 != 0) {
                $qty1 = $quantity1;
            } else {
                $qty1 = '';
            }
            if ($quantity2 != 0) {
                $qty2 = $quantity2;
            } else {
                $qty2 = '';
            }
            if ($quantity3 != 0) {
                $qty3 = $quantity3;
            } else {
                $qty3 = '';
            }
            $detail[] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'produk_harga' => number_format($a->price),
                'quantity' => $qty1 . $qty2 . $qty3,
                'total' => number_format($total),
                'diskon' => number_format($a->diskon * $jumlah1),
                'tot' => $total,
                'amount' => $total - ($a->diskon * $jumlah1),
                'id_transaksi_detail' => $a->id_transaksi_detail
            );
        }

        return view('pages.transaksi.getpayment.tabeldetail', compact('detail'));
    }

    public function addpayment(Request $r)
    {
        $invoice = $r->invoice_id;
        $data = DB::table('transaksi_sales')->where('invoice_id',$invoice)->first();
        if($data->totalsales == $r->payment)
        {
            $input = TransaksiSales::findOrFail($data->id_transaksi_sales);
            $input->status = 'PAID';
            $input->save();
        }
        $simpan = new Getpayment();
        $simpan->payment_id = $r->payment_id;
        $simpan->invoice_id = $r->invoice_id;
        $simpan->tgl_payment = date('Y-m-d');
        $simpan->payment = $r->payment;
        $simpan->status = $r->status;
        $simpan->save();
    }
}
