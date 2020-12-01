@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Report Purchase')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
<div class="col-sm-9 border p-3 mr-3">
    <div class="card-box table-responsive">
        <table id="tabel" class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap table-sm"
            cellspacing="0" width="100%">
            <thead>
                <tr>
                   <th>Invoice ID</th>
                   <th>Invoice Date</th>
                   <th>Type</th>
                   <th>Total</th>
                   <th>Diskon</th>
                   <th>Bayar</th>
                   <th>Total After Diskon</th>
                   <th>Payment Status</th>
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
</div>
</div>

<script>
    $(document).ready(function(){

      $("#waktu_awal" ).prop( "disabled", true );
      $("#waktu_akhir" ).prop( "disabled", true );

      function load_all(){
      tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/report_purchase/datatable') }}",
        },
        columns:[
        {
            data:'invoice_id'
          },{
            data:'invoice_date'
          },
          {
            data:'transaksi_tipe'
          },
          {
            data:'total'
          },
          {
            data:'diskon'
          },
          {
            data:'bayar'
          }
          ,
          {
            data:'sisa'
          },
          {
            data:'status'
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
          url: "{{ url('/api/report_purchase/today_datatable') }}",
        },
        columns:[
        {
            data:'invoice_id'
          },{
            data:'invoice_date'
          },
          {
            data:'transaksi_tipe'
          },
          {
            data:'total'
          },
          {
            data:'diskon'
          },
          {
            data:'bayar'
          }
          ,
          {
            data:'sisa'
          },
          {
            data:'status'
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
          url: "{{ url('/api/report_purchase/month_datatable/') }}/"+month+'/'+year,
        },
        columns:[
        {
            data:'invoice_id'
          },{
            data:'invoice_date'
          },
          {
            data:'transaksi_tipe'
          },
          {
            data:'total'
          },
          {
            data:'diskon'
          },
          {
            data:'bayar'
          }
          ,
          {
            data:'sisa'
          },
          {
            data:'status'
          }
        ]
      });
    }function load_year(year){
      tables = $('#tabel').DataTable({
        processing : true,
        ordering:false,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/report_purchase/year_datatable/') }}/"+year,
        },
        columns:[
        {
            data:'invoice_id'
          },{
            data:'invoice_date'
          },
          {
            data:'transaksi_tipe'
          },
          {
            data:'total'
          },
          {
            data:'diskon'
          },
          {
            data:'bayar'
          }
          ,
          {
            data:'sisa'
          },
          {
            data:'status'
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
          url: "{{ url('/api/report_purchase/range_datatable/') }}/"+waktu_awal+'/'+waktu_akhir,
        },
        columns:[
        {
            data:'invoice_id'
          },{
            data:'invoice_date'
          },
          {
            data:'transaksi_tipe'
          },
          {
            data:'total'
          },
          {
            data:'diskon'
          },
          {
            data:'bayar'
          }
          ,
          {
            data:'sisa'
          },
          {
            data:'status'
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
    window.open(`{{url('/purchase/report_purchase')}}`);
  }else if(ket_waktu == 1){
    window.open(`{{url('/purchase/report_purchase_today')}}`);
  }else if(ket_waktu == 2){
    // window.open(`{{url('/purchase/report_purchase_today')}}`);
  }else if(ket_waktu == 3){
        month = $('#month').val();
        year = $('#year').val();
        window.open(`{{url('/purchase/report_purchase_month/')}}/`+month+'/'+year);
  }
  else if(ket_waktu == 4){
        
        year = $('#year_filter').val();
        window.open(`{{url('/purchase/report_purchase_year/')}}/`+year);
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
        window.open(`{{url('/purchase/report_purchase_range/')}}/`+waktu_awal+'/'+waktu_akhir);
  }
  
    }

</script>
@endsection
