@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Salesman Achievement Report')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
    <div class="col border p-3 mr-3 bg-white rounded">
        <h6>Salesman :</h6>
        <select name="" id="data_salesman" class="form-control">
            <option value="">-SALESMAN-</option>
            @foreach($data as $a)
            <option value="{{$a->id_sales}}">{{$a->nama_sales}}</option>

            @endforeach
        </select>
        <br>
        <div class="card-body bg-dark text-white text-center text-uppercase" id="terbilang">
            <span id="target_sales" class="text-white"></span>
        </div>
        <br>
        <h6>View : </h6>
        <select name="ket_waktu" id="ket_waktu" class="form-control">
            <option value="">Silahkan Pilih</option>
            <option value="0">All Report</option>
            <option value="1">Today</option>
            <option value="2">Monthly</option>
            <option value="3">Yearly</option>
            <option value="4">Range</option>
        </select>
        <br>
        <div id="wadah"></div>
        <br>
        <div class="range" id="range">
            <legend>Range</legend>
            <input type="date" class="form-control" id="waktu_awal"><br>
            <input type="date" class="form-control" id="waktu_akhir">
        </div>
        <br>
        <div class="text-center">
            <button class="btn btn-success btn-sm btn-block" onclick="refresh()">Refresh Report</button>
            <button class="btn btn-danger btn-sm btn-block" id="generate">Generate Report</button>
        </div>
        <div>
            <label for="">Filter By :</label>
            <select name="" id="" class="form-control">
                <option value="alltransaction">-FILTER BY-</option>
                <option value="">ALL TRANSACTION</option>
                <option value="">TAKING ORDER TRANSACTION</option>
                <option value="">CASH TRANSACTION</option>
                <option value="">CREDIT TRANSACTION</option>
            </select><br>
            <input type="text" class="form-control">
        </div>
        <br>
        <div class="btn-group-vertical d-flex justify-content-center" role="group" aria-label="Basic example">
            <button type="button" onclick="allstock()" class="btn btn-outline-secondary">View All Stock</button>
            <button type="button" onclick="tostock()" class="btn btn-outline-secondary">View TO Stock</button>
            <button type="button" onclick="canvasstock()" class="btn btn-outline-secondary">View Canvas Stock</button>
        </div>
    </div>
    <div class="col-sm-9 border p-3">
        <div class="card-box table-responsive" id="isitable">

        </div>
    </div>
</div>
<script>
    var cabang = {{ session()->get('cabang')}};

    $('#data_salesman').change(function(){
        var id_sales = $(this).val()
        console.log(id_sales);
        axios.get("{{url('/api/sales_achievement/ambiltarget')}}/"+id_sales)
        .then(function(res){
            var data = res.data
            document.getElementById("target_sales").innerHTML = data.target;
        })
    })

    $('#generate').click(function () { 
        var id_sales = $('#data_salesman').val()
        console.log(id_sales);
        axios.get("{{url('/api/sales_achievement/transaksisalesachievement')}}/"+id_sales)
        .then(function(res){
            var data = res.data
            console.log(data)
            // document.getElementById("target_sales").innerHTML = data.target;
            $('#isitable').load('{{ route('table_achievement')}}/' + id_sales)
        })
    });

    function allstock()
    {
    window.open(`{{url('/sales_achievement/report_all_stock')}}`);
    }

    function tostock()
    {
    window.open(`{{url('/sales_achievement/report_to_stock')}}`);
    }

    function canvasstock()
    {
    window.open(`{{url('/sales_achievement/report_canvas_stock')}}`);
    }

    $("#waktu_awal" ).prop( "readonly", true );
        $("#waktu_akhir" ).prop( "readonly", true );
        $('#ket_waktu').change(function(){
            $("waktu_awal").val('0');
            $("waktu_akhir").val('0');
            $("#waktu_awal" ).prop( "readonly", true );
            $("#waktu_akhir" ).prop( "readonly", true );
            nilai = $('#ket_waktu').val();
            $('#wadah').html('');

            if(nilai ==2){
                $('#wadah').append(`<select name="year" id="year" class="form-control">
                <?php
                    $year = date('Y');
                    $min = $year - 10;
                    $max = $year;
                    for( $i=$max; $i>=$min; $i-- ) {
                    echo '<option value='.$i.'>'.$i.'</option>';
                    }
                ?>
                </select><br> <select class="form-control" name="month" id="month"><option>Pilih Bulan</option>
                <?php for( $m=1; $m<=12; ++$m ) {
                    $month_label = date('F', mktime(0, 0, 0, $m, 1));
                ?>
                    <option value="<?php echo $m; ?>"><?php echo $month_label; ?></option>
                <?php } ?>
                    </select>  `);
            }else if(nilai ==3){
                $('#wadah').append(`<select name="year_filter" id="year_filter" class="form-control"><option>Pilih Tahun</option>
                <?php
                    $year = date('Y');
                    $min = $year - 10;
                    $max = $year;
                    for( $i=$max; $i>=$min; $i-- ) {
                    echo '<option value='.$i.'>'.$i.'</option>';
                    }
                ?>
                </select>`);
            }else if(nilai ==4){
                $("#waktu_awal" ).prop( "readonly", false);
                $("#waktu_akhir" ).prop( "readonly", false);
            }
        })

    
    function refresh()
    {
        window.location.reload()
    }
</script>
@endsection