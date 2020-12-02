<?php

namespace App\Http\Controllers\transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Stok;
use App\Models\BrokenExpMovement;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrokenExpMovementController extends Controller
{
    public function __construct()
    {
        $this->rules = array(
            'id_broken_exp' => 'numeric',
        );
        $this->dataisi = [];
    }

    public function index()
    {
        $cabang = session()->get('cabang');
        $id = strlen(session()->get('id'));
        $inv = DB::table('tbl_broken_exp')->orderBy('id_broken_exp', 'desc')->first();
        if ($id == 1) {
            $user = '00' . session()->get('id');
        } else if ($id == 2) {
            $user = '0' . session()->get('id');
        } else if ($id == 3) {
            $user = session()->get('id');
        }
        if ($inv == NULL) {
            $invoice = 'MBS-' . date('Ym') . "-" . $user . '-1';
        } else {
            $cekinv = substr($inv->invoice_id, 15, 50);
            $plus = (int)$cekinv + 1;
            $invoice = 'MBS-' . date('Ym') . "-" . $user . '-' . $plus;
        }
        $data['invoice'] = $invoice;
        $data['stockid'] = DB::table('tbl_produk')
            ->join('tbl_stok', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->where('tbl_stok.id_cabang', $cabang)
            ->select('*')
            ->get();
        return view("pages.transaksi.brokenexpmovement.index", $data);
    }

    // public function data($id)
    // {
    //     // untuk datatables Sistem Join Query Builder
    //     $data = $this->join_builder($id);
    //     $format = '%d,%s';
    //     $stok = [];
    //     $this->dataisi = [];
    //     foreach ($data as $d) {
    //         $id = $d->produk_id;
    //         $jumlah = $d->jumlah;
    //         $harga = $d->capital_price;
    //         $stok_id = $d->stok_id;
    //         $produk_nama = $d->produk_nama;
    //         $produk_brand = $d->produk_brand;
    //         $nama_type_produk = $d->nama_type_produk;
    //         // untuk mencari nilai unitnya, karton, bungkus, pieces
    //         $proses = DB::table('tbl_unit')->where('produk_id', $id)
    //             ->join('tbl_satuan', 'tbl_unit.maximum_unit_name', '=', 'tbl_satuan.id_satuan')
    //             ->select('id_unit', 'nama_satuan as unit', 'default_value')
    //             ->orderBy('id_unit', 'ASC')
    //             ->get();
    //         $hasilbagi = 0;
    //         foreach ($proses as $index => $list) {
    //             // banyak adalah hasil dari jumlah array proses
    //             $banyak = sizeof($proses);

    //             if ($index == 0) {
    //                 // cari sisa jumlah dengan menggunakan modulus
    //                 $sisa = $jumlah % $list->default_value;
    //                 $hasilbagi = ($jumlah - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $lebih[$index] = $sisa;
    //                 if ($sisa > 0) {
    //                     $stok[$index] = sprintf($format, $sisa, $list->unit);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             } else if ($index == 1) {
    //                 $sisa = $hasilbagi % $list->default_value;
    //                 $hasilbagi = ($hasilbagi - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $lebih[$index] = $sisa;

    //                 if ($sisa > 0) {
    //                     $stok[$index - 1] = sprintf($format, $sisa + $lebih[$index - 1], $satuan[$index - 1]);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             } else if ($index == 2) {
    //                 $sisa = $hasilbagi % $list->default_value;
    //                 $hasilbagi = ($hasilbagi - $sisa) / $list->default_value;
    //                 $satuan[$index] = $list->unit;
    //                 $lebih[$index] = $sisa;
    //                 if ($sisa > 0) {
    //                     $stok[$index - 1] = sprintf($format, $sisa,  $satuan[$index - 1]);
    //                 }
    //                 if ($banyak == $index + 1) {
    //                     $satuan = array();
    //                     $stok[$index] = sprintf($format, $hasilbagi, $list->unit);
    //                     $stokquantity = array_values($stok);
    //                     $stok = array();
    //                 }
    //             }
    //         }

    //         $this->dataisi[] = [
    //             "stok" => $stokquantity,
    //             "stok_id" => $stok_id,
    //             "satuan_price" => $harga,
    //             "produk_id" => $id,
    //             "produk_nama" => $produk_nama,
    //             "produk_brand" => $produk_brand,
    //             "nama_type_produk" => $nama_type_produk
    //         ];
    //     }

    //     // return datatables()->of($this->dataisi)->toJson();
    // }

    // public function join_builder($id)
    // {
    //     $data = DB::table('tbl_stok')
    //         ->where('stok_id', $id)
    //         ->leftJoin('tbl_produk', 'tbl_produk.produk_id', '=', 'tbl_stok.produk_id')
    //         ->leftJoin('tbl_type_produk', 'tbl_type_produk.id_type_produk', '=', 'tbl_produk.id_type_produk')
    //         ->select('tbl_stok.jumlah', 'tbl_produk.produk_id', 'tbl_produk.produk_nama', 'tbl_produk.produk_brand', 'tbl_type_produk.nama_type_produk', 'tbl_stok.capital_price', 'tbl_stok.stok_id')
    //         ->get();
    //     return $data;
    // }

    // public function ambildatastok(Request $request, $id = null)
    // {
    //     try {
    //         if ($id) {
    //             $data = DB::table('tbl_stok')->where('stok_id', $id)
    //                 ->leftJoin('tbl_produk', 'tbl_produk.produk_id', '=', 'tbl_stok.produk_id')
    //                 ->leftJoin('tbl_type_produk', 'tbl_type_produk.id_type_produk', '=', 'tbl_produk.id_type_produk')
    //                 ->select('*')
    //                 ->get();

    //             // $data = Stok::with(["produk.type", "produk.satuan", "cabang", "produk.unit.maximum_unit_name", "produk.unit.minimum_unit_name"])->findOrFail($id);
    //         } else {
    //             $data = Stok::all();
    //         }
    //         // dd($data);
    //         return response()->json(['data' => $data, 'status' => 200]);
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
    //     }
    // }

    // public function ambildatastok($id)
    // {
    //     $data =   DB::table('tbl_stok')
    //         ->where('stok_id', $id)
    //         ->leftJoin('tbl_produk', 'tbl_produk.produk_id', '=', 'tbl_stok.produk_id')
    //         ->leftJoin('tbl_type_produk', 'tbl_type_produk.id_type_produk', '=', 'tbl_produk.id_type_produk')
    //         ->select('tbl_stok.jumlah', 'tbl_produk.produk_id', 'tbl_produk.produk_nama', 'tbl_produk.produk_brand', 'tbl_type_produk.nama_type_produk', 'tbl_stok.capital_price', 'tbl_stok.stok_id')
    //         ->get();
    //     if ($data == TRUE) {
    //         return response()->json(['data' => $data, 'status' => 200]);
    //     } else {
    //         return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
    //     }
    //     $tmp = $this->data($id);
    //     $data = $this->dataisi;
    // return response()->json(['data' => $data]);
    // }

    public function ambildatastok(Request $r, $id = null)
    {
        // $cab = $r->cabang;
        // $id = $r->produk_id;
        $data =  DB::table('tbl_produk')
            ->select('*')
            ->join('tbl_stok', 'tbl_produk.produk_id', 'tbl_stok.produk_id')
            ->join('tbl_type_produk', 'tbl_produk.id_type_produk', 'tbl_type_produk.id_type_produk')
            ->where('tbl_stok.produk_id', $id)
            // ->where('tbl_stok.id_cabang', $cab)
            ->get();
        // dd($data);
        if ($data == TRUE) {
            return response()->json(['data' => $data, 'status' => 200]);
        } else {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function cekdatastok(Request $r)
    {
        $id = $r->produk_id;
        $data = DB::table('tbl_unit')
            ->where('tbl_unit.produk_id', $id)
            ->join('tbl_satuan', 'tbl_unit.maximum_unit_name', '=', 'tbl_satuan.id_satuan')
            ->select('tbl_unit.id_unit', 'tbl_satuan.nama_satuan as unit', 'tbl_unit.default_value')
            ->orderBy('tbl_unit.id_unit', 'ASC')
            ->get();
        if ($data == TRUE) {
            return response()->json(['data' => $data, 'status' => 200]);
        } else {
            return response()->json(['message' => 'Data Tidak Ditemukan', 'status' => 404]);
        }
    }

    public function datatablesbem()
    {
        $id = Session()->get('id');
        $data = DB::table('tbl_broken_exp_tmp')
            ->leftJoin('tbl_stok', 'tbl_stok.stok_id', 'tbl_broken_exp_tmp.stok_id')
            ->leftJoin('tbl_produk', 'tbl_produk.produk_id', '=', 'tbl_stok.produk_id')
            ->leftJoin('tbl_type_produk', 'tbl_type_produk.id_type_produk', '=', 'tbl_produk.id_type_produk')
            ->select('tbl_stok.jumlah', 'tbl_produk.produk_id', 'tbl_produk.produk_harga', 'tbl_produk.produk_nama', 'tbl_produk.produk_brand', 'tbl_type_produk.nama_type_produk', 'tbl_stok.capital_price', 'tbl_stok.stok_id', 'tbl_broken_exp_tmp.*')
            ->where('tbl_broken_exp_tmp.id_user', $id)
            ->get();
        foreach ($data as $a) {
            // pecah data unit
            if ($a->unit_1 != NULL) {

                $uang1 = $a->produk_harga * $a->unit_1;
                // cek satuan
                $nilaisisa1 = 0;
                $nilaikonversi1 = $a->unit_1;
            } else {
                $nilaisisa1 = 0;
                $nilaikonversi1 = 0;
                $uang1 = 0;
            }
            // pecah data unit
            if ($a->unit_2 != NULL) {
                // cek satuan
                $unit2 = DB::table('tbl_unit')
                    ->join('tbl_satuan', 'tbl_satuan.id_satuan', 'tbl_unit.maximum_unit_name')
                    ->where('tbl_unit.produk_id', $a->produk_id)
                    ->where('tbl_satuan.nama_satuan', $a->unit_2)
                    ->first();
                $nilaisisa2 = $a->unit_2 % $unit2->default_value;
                $nilaikonversi2 = ($a->unit_2 - $nilaisisa2) / $unit2->default_value;
                $uang2 = $a->produk_harga / $unit2->default_value;
            } else {
                $nilaisisa2 = 0;
                $nilaikonversi2 = 0;
                $uang2 = 0;
            }
            // pecah data unit
            if ($a->unit_3 != NULL) {
                // cek satuan
                $unit3 = DB::table('tbl_unit')
                    ->join('tbl_satuan', 'tbl_satuan.id_satuan', 'tbl_unit.maximum_unit_name')
                    ->where('tbl_unit.produk_id', $a->produk_id)
                    ->where('tbl_satuan.nama_satuan', $a->unit_3)
                    ->first();
                $nilaisisa3 = $a->unit_3 % $unit3->default_value;
                $nilaikonversi3 = ($a->unit_3 - $nilaisisa2) / $unit3->default_value;
                $uang3 = $a->produk_harga / $unit3->default_value;
            } else {
                $nilaisisa3 = 0;
                $nilaikonversi3 = 0;
                $uang3 = 0;
            }

            $quantity1 =  ($nilaikonversi1 + $nilaikonversi2) . " | ";
            $quantity2 =  ($nilaisisa1 + $nilaisisa2 + $nilaikonversi3) . " | ";
            $quantity3 =  ($nilaisisa3) . " | ";
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
            $init[] = array(
                'stok_id' => $a->stok_id,
                'produk_id' => $a->produk_id,
                'nama_type_produk' => $a->nama_type_produk,
                'produk_brand' => $a->produk_brand,
                'produk_nama' => $a->produk_nama,
                'produk_harga' => number_format($a->produk_harga),
                'quantity' => $qty1 . $qty2 . $qty3,
                'id_broken_exp_tmp' => $a->id_broken_exp_tmp
            );
            // dd($init);
        }
        // dd($init);
        return view('pages.transaksi.brokenexpmovement.table', compact('init'));
    }
}
