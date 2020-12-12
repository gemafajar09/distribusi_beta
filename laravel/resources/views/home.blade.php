@extends('layout.index')
@section('page-title','Home Page')
@section('content')
<!-- page content -->

<!-- <div class="row" style="display: inline-block;">
    <div class=" top_tiles" style="margin: 10px 0;">
        <div class="col-md-3 col-sm-3  tile">
            <span>Total Sessions</span>
            <h2>231,809</h2>
            <span class="sparkline_one" style="height: 160px;">
                <canvas width="200" height="60"
                    style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
            </span>
        </div>
        <div class="col-md-3 col-sm-3  tile">
            <span>Total Revenue</span>
            <h2>$ 231,809</h2>
            <span class="sparkline_one" style="height: 160px;">
                <canvas width="200" height="60"
                    style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
            </span>
        </div>
        <div class="col-md-3 col-sm-3  tile">
            <span>Total Sessions</span>
            <h2>231,809</h2>
            <span class="sparkline_one" style="height: 160px;">
                <canvas width="200" height="60"
                    style="display: inline-block; vertical-align: top; width: 94px; height: 125px;"></canvas>
            </span>
        </div>
        <div class="col-md-3 col-sm-3  tile">
            <span>Total Sessions</span>
            <h2>231,809</h2>
            <span class="sparkline_one" style="height: 160px;">
                <canvas width="200" height="60"
                    style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
            </span>
        </div>
    </div>
</div>
<br /> -->

<!-- <div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="dashboard_graph x_panel">
            <div class="x_title">
                <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                </div>
                <div class="col-md-6">
                    <div id="reportrange" class="pull-right"
                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                </div>
            </div>
            <div class="x_content">
                <div class="demo-container" style="height:250px">
                    <div id="chart_plot_03" class="demo-placeholder"></div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Produk</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('produk')}}" class="btn btn-success btn-lg">View Produk</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Stok</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('stok')}}" class="btn btn-success btn-lg">View Stok</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Satuan</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{ route('satuan') }}" class="btn btn-success btn-lg">View Satuan</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Sales</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{ route('sales') }}" class="btn btn-success btn-lg">View Sales</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Suplier</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{ route('suplier') }}" class="btn btn-success btn-lg">View Suplier</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Customer</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('customer')}}" class="btn btn-success btn-lg">View Customer</a>
                </div>
                </div>

            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Special Price</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('spesial')}}" class="btn btn-success btn-lg">Special Price</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Type Produk</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('type')}}" class="btn btn-success btn-lg">Type Produk</a>
                </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 ">
        <div class="x_panel fixed_height_100">
            <div class="x_title">
                <h2>Master <small>Unit Listing</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="row">
                   <div class="col-sm-5">
                <i class="fa fa-database fa-5x"></i>
                </div>
                <div class="col-sm-7">
                    <a href="{{route('unit')}}" class="btn btn-success btn-lg">Unit Listing</a>
                </div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /page content -->
@endsection
