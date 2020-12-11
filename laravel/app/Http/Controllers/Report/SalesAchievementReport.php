<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesAchievementReport extends Controller
{
    public function index()
    {
        return view("report.salesachievement.index");
    }

    public function printallstock()
    {
        return view("report.salesachievement.printallstock");
    }

    public function printtostock()
    {
        return view("report.salesachievement.printtostock");
    }

    public function printcanvasstock()
    {
        return view("report.salesachievement.printcanvasstock");
    }
}
