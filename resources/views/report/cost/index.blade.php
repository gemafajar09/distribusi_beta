@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Cost Report')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
    <div class="col-sm-9 border p-3 mr-3">
        <div class="card-box table-responsive">
            <table id="tabel"
                class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap table-sm"
                cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Cost ID</th>
                        <th>ID Requester</th>
                        <th>Name</th>
                        <th>Cost Name</th>
                        <th>Nominal</th>
                        <th>Costing Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col border p-3 bg-white rounded">
        <h6>View : </h6>
        <select name="ket_waktu" id="ket_waktu" class="form-control">
            <option value="">Silahkan Pilih</option>
            <option value="0">All Report</option>
            <option value="1">Today</option>
            <!-- <option value="2">Weekly</option> -->
            <option value="3">Monthly</option>
            <option value="4">Yearly</option>
            <option value="5">Range</option>
        </select>
        <br>
        <div id="wadah"></div>
        <br>
        <div class="range" id="range">
            <legend>Range</legend>
            <input type="date" class="form-control" id="waktu_awal" onchange="range_report()"><br>
            <input type="date" class="form-control" id="waktu_akhir" onchange="range_report()">
        </div>
        <br>
        <div class="text-center">
            <button class="btn btn-success btn-sm btn-block" onclick="location.reload()">Refresh Report</button>
            <button class="btn btn-danger btn-sm btn-block" onclick="print_report()">Generate Report</button>
        </div>
        <div>
            <input type="checkbox" id="alldata"> &nbsp; ALL TRANSACTION
            <label for="">Filter By :</label>
            <select name="" id="pilihanfilter" class="form-control">
                <option value="alltransaction">-FILTER BY-</option>
                <option value="idrequester">ID REQUESTER</option>
                <option value="namarequester">NAME REQUESTER</option>
                <option value="costnama">COST NAME</option>
            </select><br>
            <input type="text" onkeyup="pilihanfilter(this)" class="form-control" id="inputpilihan">
        </div>
    </div>
</div>
<script>
    document.getElementById('alldata').addEventListener('click',function(){
        var cek = document.getElementById('alldata').checked;
        if(cek == true)
        {
            axios.get("").then(function(res){

            }).catch(function(err){
                console.log(err)
            })
        }
    })

    $(document).ready(function(){

        $("#waktu_awal" ).prop( "disabled", true );
        $("#waktu_akhir" ).prop( "disabled", true );
        function load_all(){
        tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
                url: "{{ url('/api/cost_report/datatable') }}",
                },
                columns:[
                {
                    data: 'inv_cost'
                },
                {
                    data: 'id_sales'
                },
                {
                    data: 'nama_sales'
                },
                {
                    data: 'cost_nama'
                },
                {
                    data: 'nominal'
                },
                {
                    data: 'tanggal'
                }
        ]
        });
        }
        function load_today(){
        tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
            url: "{{ url('/api/cost_report/today_datatable') }}",
            },
            columns:[
                {
                    data: 'inv_cost'
                },
                {
                    data: 'id_sales'
                },
                {
                    data: 'nama_sales'
                },
                {
                    data: 'cost_nama'
                },
                {
                    data: 'nominal'
                },
                {
                    data: 'tanggal'
                }
        ]
        });
        }
        function load_month(month){
        tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
                url: "{{ url('/api/cost_report/month_datatable/') }}/"+month+'/'+year,
                },
                columns:[
                {
                    data: 'inv_cost'
                },
                {
                    data: 'id_sales'
                },
                {
                    data: 'nama_sales'
                },
                {
                    data: 'cost_nama'
                },
                {
                    data: 'nominal'
                },
                {
                    data: 'tanggal'
                }
        ]
        });
        }
        function load_year(year){
        tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
            url: "{{ url('/api/cost_report/year_datatable/') }}/"+year,
        },
            columns:[
                    {
                        data: 'inv_cost'
                    },
                    {
                        data: 'id_sales'
                    },
                    {
                        data: 'nama_sales'
                    },
                    {
                        data: 'cost_nama'
                    },
                    {
                        data: 'nominal'
                    },
                    {
                        data: 'tanggal'
                    }
            ]
        });
        }

        $('#ket_waktu').change(function(){
            $("#waktu_awal" ).prop( "disabled", true );
            $("#waktu_akhir" ).prop( "disabled", true );
        nilai = $('#ket_waktu').val();
        $('#wadah').html('');
        // weekly
        if(nilai == 0){
            if ( $.fn.DataTable.isDataTable('#tabel') ) {
                $('#tabel').DataTable().destroy();
            }
            load_all()
        }else if(nilai ==1){
            if ( $.fn.DataTable.isDataTable('#tabel') ) {
                $('#tabel').DataTable().destroy();
            }
            load_today()
        }else if(nilai ==2){
                console.log("oke2");
        }else if(nilai ==3){
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
        }else if(nilai ==4){
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
        }else if(nilai ==5){
            $("#waktu_awal" ).prop( "disabled", false );
            $("#waktu_akhir" ).prop( "disabled", false );
        }
        })

        $('#wadah').on('change', '#month', function() {
        month = $('#month').val();
        year = $('#year').val();
        if ( $.fn.DataTable.isDataTable('#tabel') ) {
                $('#tabel').DataTable().destroy();
            }
        load_month(month,year)
        });

        $('#wadah').on('change', '#year_filter', function() {
        year = $('#year_filter').val();
        if ( $.fn.DataTable.isDataTable('#tabel') ) {
                $('#tabel').DataTable().destroy();
            }
        load_year(year)
        });
    });

    function load_range(waktu_awal,waktu_akhir){
    tables = $('#tabel').DataTable({
    processing : true,
    ordering:false,
    serverSide : true,
    ajax:{
        url: "{{ url('/api/cost_report/range_datatable/') }}/"+waktu_awal+'/'+waktu_akhir,
    },
        columns:[
                {
                    data: 'inv_cost'
                },
                {
                    data: 'id_sales'
                },
                {
                    data: 'nama_sales'
                },
                {
                    data: 'cost_nama'
                },
                {
                    data: 'nominal'
                },
                {
                    data: 'tanggal'
                }
        ]
    });
    }

    function range_report(){
    waktu_awal = $('#waktu_awal').val();
    if(waktu_awal == ""){
    return false;
    }
    waktu_akhir = $('#waktu_akhir').val();
    if(waktu_akhir == ""){
    return false;
    }
    if ( $.fn.DataTable.isDataTable('#tabel') ) {
            $('#tabel').DataTable().destroy();
        }
    load_range(waktu_awal,waktu_akhir)
    }

    function print_report(){
    ket_waktu = $('#ket_waktu').val();
    if(ket_waktu == 0){
    window.open(`{{url('/cost_report/report_cost')}}`);
    }else if(ket_waktu == 1){
    window.open(`{{url('/cost_report/report_cost_today')}}`);
    }else if(ket_waktu == 2){
    // window.open(`{{url('/cost/report_cost_today')}}`);
    }else if(ket_waktu == 3){
    month = $('#month').val();
    year = $('#year').val();
    window.open(`{{url('/cost_report/report_cost_month/')}}/`+month+'/'+year);
    }
    else if(ket_waktu == 4){

    year = $('#year_filter').val();
    window.open(`{{url('/cost_report/report_cost_year/')}}/`+year);
    }
    else if(ket_waktu == 5){

        waktu_awal = $('#waktu_awal').val();
        if(waktu_awal == ""){
        return false;
        }
        waktu_akhir = $('#waktu_akhir').val();
        if(waktu_akhir == ""){
        return false;
        }
    window.open(`{{url('/cost_report/report_cost_range/')}}/`+waktu_awal+'/'+waktu_akhir);
    }
}


    function pilihanfilter(fil)
    {
        var cari = fil.value
        var filterdata = $('#pilihanfilter').val()
        var caridata = $('#inputpilihan').val()
        if(filterdata == "idrequester")
        {
            axios.post("",{'id':cari}).then(function(res){

            })
        }
        else if(filterdata == 'namarequester')
        {
            axios.post("",{'id':cari}).then(function(res){

            })
        }
        else if(filterdata == 'costnama')
        {
            axios.post("",{'id':cari}).then(function(res){

            })
        }
    }
</script>
@endsection
