<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CostReport extends Controller
{
    public function index()
    {
        return view('report.cost.index');
    }

    public function datatable()
    {
        $data = DB::table('tbl_cost')
            ->select('*')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->orderby('cost_id', 'asc')
            ->get();
        return datatables()->of($data)->toJson();
    }

    public function findId($select = null, $input = null, $ket_waktu = null, $filtertahun = null, $filterbulan = null, $filter_year = null, $waktuawal = null, $waktuakhir = null)
    {
        $data = DB::table('tbl_cost')
            ->select('*')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->orderby('cost_id', 'asc');
        if (!empty($select)) {
            if ($select == 'idrequester') {
                $data = $data->where('tbl_sales.id_sales', $input);
            } elseif ($select == 'namarequester') {
                $data = $data->where('tbl_sales.nama_sales', $input);
            } elseif ($select == 'costnama') {
                $data = $data->where('tbl_cost.cost_nama', $input);
            }
        }
        if (!empty($ket_waktu)) {
            if ($ket_waktu == 0) {
                $data = $data->select('*')->get();
            }
            if ($ket_waktu == 1) {
                $data = $data->whereRaw('Date(tanggal) = CURDATE()');
            }
            if ($ket_waktu == 3) {
                $data = $data->whereMonth('tanggal', $filterbulan)->whereYear('tanggal', $filtertahun);
            }
            if ($ket_waktu == 4) {
                $data = $data->whereYear('tanggal', $filter_year);
            }
            if ($ket_waktu == 5) {
                $data = $data->whereBetween('tanggal', $waktuawal, $waktuakhir);
            }
        }
        $data = $data->select('*')->get();
        return view('report.cost.table', $data);
        // dd($data);
        // return datatables()->of($data)->toJson();
    }

    public function generatereport($select = null, $input = null, $ket_waktu = null, $filtertahun = null, $filterbulan = null, $filter_year = null, $waktuawal = null, $waktuakhir = null)
    {
        $data = DB::table('tbl_cost')
            ->select('*')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->orderby('cost_id', 'asc');
        if (!empty($select)) {
            if ($select == 'idrequester') {
                $data = $data->where('tbl_sales.id_sales', $input);
            } elseif ($select == 'namarequester') {
                $data = $data->where('tbl_sales.nama_sales', $input);
            } elseif ($select == 'costnama') {
                $data = $data->where('tbl_cost.cost_nama', $input);
            }
        }
        if (!empty($ket_waktu)) {
            if ($ket_waktu == 0) {
                $data = $data->select('*')->get();
            }
            if ($ket_waktu == 1) {
                $data = $data->whereRaw('Date(tanggal) = CURDATE()');
            }
            if ($ket_waktu == 3) {
                $data = $data->whereMonth('tanggal', $filterbulan)->whereYear('tanggal', $filtertahun);
            }
            if ($ket_waktu == 4) {
                $data = $data->whereYear('tanggal', $filter_year);
            }
            if ($ket_waktu == 5) {
                $data = $data->whereBetween('tanggal', $waktuawal, $waktuakhir);
            }
        }
        $data = $data->select('*')->get();
        return view('report.cost.printcostview', compact('data'));
    }

    public function today_datatable()
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereRaw('Date(tanggal) = CURDATE()')
            ->get();
        return datatables()->of($data)->toJson();
    }

    public function month_datatable($month, $year)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->get();
        return datatables()->of($data)->toJson();
    }

    public function year_datatable($year)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereYear('tanggal', $year)->get();
        return datatables()->of($data)->toJson();
    }

    public function range_datatable($from, $to)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereBetween('tanggal', [$from, $to])
            ->get();
        return datatables()->of($data)->toJson();
    }

    public function report()
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->get();
        return view('report.cost.printcostview', compact('data'));
    }

    public function report_today()
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereRaw('Date(tanggal) = CURDATE()')
            ->get();
        return view('report.cost.printcostview', compact('data'));
    }

    public function report_month($month, $year)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereMonth('tanggal', $month)->whereYear('tanggal', $year)->get();
        return view('report.cost.printcostview', compact('data'));
    }

    public function report_year($year)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereYear('tanggal', $year)->get();
        return view('report.cost.printcostview', compact('data'));
    }

    public function report_range($from, $to)
    {
        $data = DB::table('tbl_cost')
            ->leftJoin('tbl_sales', 'tbl_sales.id_sales', 'tbl_cost.id_sales')
            ->select('*')
            ->orderby('cost_id', 'asc')
            ->whereBetween('tanggal', [$from, $to])
            ->get();
        return view('report.cost.printcostview', compact('data'));
    }
}
