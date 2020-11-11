@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Sales')
<!-- Page Content -->
@section('content')
<h1>Sales</h1>
<div class="mt-2">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Sales</label>
                        <input type="text" id="nama_sales" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="number" id="telepon" class="form-control">
                    </div>
                    <button type="button" class="btn btn-success btn-round" id="add"><i class="fa fa-plus"></i></button>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="" id="alamat" cols="30" rows="5" class="form-control"></textarea>
                </div>
                </form>
            </div>
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="tabel" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sales</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-minus"></i> Edit Data Sales</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Sales</label>
                    <input type="hidden" id="id_sales">
                    <input type="text" class="form-control" id="nm_sales">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="" id="almt" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Telepon</label>
                    <input type="number" class="form-control" id="tlpn">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="editData()" type="button">Edit Data</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/sales/datatable') }}",
        },
        columns:[
        {
            data: null,
            render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
          {
            data: 'nama_sales'
          },
          {
            data:'alamat'
          },
          {
            data:'telepon'
          },
          {
            data: null,
            render: function(data, type, row, meta) {
            return "<div>" +
                "<button type='button' onclick='deleted(" + data.id_sales + ")' class='btn btn-danger'>Hapus</button> | " +
                "<button type='button' onclick='ambilData(" + data.id_sales + ")' class='btn btn-success'>Edit</button>" +
            "</div>" ;
            }
          }
        ]
      });
    });

    $('#add').click(function(e){
        e.preventDefault();
        var nama_sales = $('#nama_sales').val();
        var alamat = $('#alamat').val();
        var telepon = $('#telepon').val();

        axios.post('{{url('/api/sales/')}}',{
            nama_sales: nama_sales,
            alamat: alamat,
            telepon: telepon
        })
        .then(function (res) {
            var data = res.data
            console.log(data.status)
            if(data.status == 200)
            {
                bersih()
                tables.ajax.reload()
                toastr.info(data.message)
            }
        })
    })

    function deleted(id)
    {
        axios.delete('{{url('/api/sales/remove')}}/'+id)
            .then(function(res){
            var data = res.data
            tables.ajax.reload()
            toastr.info(data.message)
        })
    }

    function ambilData(id)
    {
        axios.get('{{url('/api/sales')}}/'+ id)
        .then(function(res) {
            var isi = res.data
            console.log(isi.data)
            document.getElementById('id_sales').value=isi.data.id_sales;
            document.getElementById('nm_sales').value=isi.data.nama_sales;
            document.getElementById('almt').value=isi.data.alamat;
            document.getElementById('tlpn').value=isi.data.telepon;
            $('#modal').modal('show');
        })
    }

    function editData()
    {
        var id_sales = document.getElementById('id_sales').value;
        var nama_sales = document.getElementById('nm_sales').value;
        var alamat = document.getElementById('almt').value;
        var telepon = document.getElementById('tlpn').value;
        axios.put('{{url('/api/sales')}}',{
            'id_sales':id_sales,
            'nama_sales':nama_sales,
            'alamat':alamat,
            'telepon':telepon,
        }).then(function(res){
            var data = res.data
            toastr.info(data.message)
            $('#modal').modal('hide')
            tables.ajax.reload()
        })
    }

    function bersih()
    {
        $('#nama_sales').val('')
        $('#alamat').val('')
        $('#telepon').val('')
    }
</script>
@endsection
