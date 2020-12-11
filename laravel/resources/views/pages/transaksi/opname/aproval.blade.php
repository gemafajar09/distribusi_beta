@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Aproval Opname And Adjustment')
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
                   
                    <th >Stok ID</th>
                    <th >Produk Nama</th>
                    <th>Jumlah System</th>
                    <th>Jumlah Fisik</th>
                    <th>Selisih</th>
                    <th>Tanggal Pengajuan</th>
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


<script>
    $(document).ready(function(){
      {{$cabang = session()->get('cabang')}}
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: '{{ url("/api/aprovalopname/datatable/".$cabang) }}', 
        },
        columns:[
          
          {
            data:'stok_id',
            defaultContent:""
          },
          {
            data:'produk_nama',
            defaultContent:""
          },
          {
            data:'jumlah',
            defaultContent:""
          },
          {
            data:'jumlah_fisik',
            defaultContent:""
          },
          {
            data:'selisih',
            defaultContent:""
          },
          {
            data:'date_adjust',
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
                "<button type='button'  onclick='aproval(" + data.id_aproval_opname + ")' class='btn btn-success btn-sm'>Simpan</button> "+
            "</div>" ;
            }
          }
        ]
      });
            });


    function aproval(id){
        aprove = $('#approval').val();
        axios.post('{{url('/api/opname/approval/')}}',{
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
