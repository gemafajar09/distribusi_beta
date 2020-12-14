@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Sales Transaction Report')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
    <div class="col-sm-9 border p-3 mr-3">
        <div class="card-box table-responsive" id="isitable">

        </div>
    </div>
    <div class="col border p-3 bg-white rounded">
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
            <button class="btn btn-success btn-sm btn-block">Refresh Report</button>
            <button class="btn btn-danger btn-sm btn-block">Generate Report</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#isitable').load('{{ route('table_sales_transaksi')}}')
    });

    $("#waktu_awal" ).prop( "readonly", true );
    $("#waktu_akhir" ).prop( "readonly", true );
    $('#ket_waktu').change(function(){
        $("#waktu_awal" ).prop( "readonly", true );
        $("#waktu_akhir" ).prop( "readonly", true );
        var nilai = $('#ket_waktu').val();
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
        $("#waktu_awal").val("")
        $("#waktu_akhir").val("")
    })
</script>
@endsection