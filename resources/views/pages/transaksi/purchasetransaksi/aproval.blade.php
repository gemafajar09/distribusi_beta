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
                    <th >Type Produk</th>
                    
                    <th >Nama Produk</th>
                    <th >Harga</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Total Price</th>
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
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/purchasedetail/datatable') }}", 
        },
        columns:[
          {
            data:'nama_type_produk',
            defaultContent:""
          },
          {
            data:'produk_nama',
            defaultContent:""
          },
          {
            data:'unit_satuan_price',
            defaultContent:""
          },
          {
            data:'stok_quantity',
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
            data:'total_price',
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
                "<button type='button'  onclick='aproval(" + data.id_transaksi_purchase_detail + ")' class='btn btn-success btn-sm'>Simpan</button> "+
            "</div>" ;
            }
          }
        ]
      });
            });


    function aproval(id){
        id = id;
        aprove = $('#approval').val();
        axios.post('{{url('/api/purchasedetail/approval/')}}/',{
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
