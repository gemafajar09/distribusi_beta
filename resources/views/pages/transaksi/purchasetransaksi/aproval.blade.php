@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Aproval Purchase Order')
<!-- Page Content -->
@section('content')
 
<div class="row">
<div class="col-sm-12">
<button class="btn btn-info" onclick="refresh()"><i class="fa fa-refresh"></i> Refresh</button>
    <div class="card-box table-responsive">
        <table id="tabel" class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap"
            cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th >Invoice ID</th>
                    <th >Invoice Date</th>
                    <th >Nama Suplier</th>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Bayar</th>
                    <th>Sisa</th>
                    <th>Aproval</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
        <!-- <button onclick="register()" class="btn btn-danger btn-sm">Register Transaksi</button> -->
        
    </div>
</div>
</div>

<!-- Modal -->


<script>
    $(document).ready(function(){
      {{$cabang = session()->get('cabang')}}
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: '{{ url("/api/purchasedetail/datatable/".$cabang) }}', 
        },
        columns:[
          {
            data:'invoice_id',
            defaultContent:""
          },
          {
            data:'invoice_date',
            defaultContent:""
          },
          {
            data:'nama_suplier',
            defaultContent:""
          },
          {
            data:'total',
            defaultContent:""
          },
          {
            data:'diskon',
            defaultContent:""
          },
          {
            data:'bayar',
            defaultContent:""
          },
          {
            data:'sisa',
            defaultContent:""
          },
          {
            defaultContent:"",
            data: null,
            render: function(data, type, row, meta) {
            return "<div><select id='approval'><option value='1'>Approval</option><option value='2'>Not Approval</option></select></div>";
            }  
          }
          ,
          {
            defaultContent:"",
            data: null,
            render: function(data, type, row, meta) {
            return "<div>" +
                "<button type='button'  onclick='aproval(" + data.id_transaksi_purchase + ")' class='btn btn-success btn-sm'>Simpan</button> "+
            "</div>" ;
            }
          }
        ]
      });
            });


    function aproval(id){
        aprove = $('#approval').val();
        axios.post('{{url('/api/purchasedetail/approval/')}}',{
            'id':id,
            'status':aprove
        }).then(function(res){
            var data = res.data
            tables.ajax.reload()
            toastr.info(data.message)
        })
    }

    function refresh(){
      tables.ajax.reload()
    }

</script>
@endsection
