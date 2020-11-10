@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Satuan')
<!-- Page Content -->
@section('content')
<div class="mt-2">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Satuan</label>
                        <input type="text" class="form-control" id="nama_satuan">
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan Satuan</label>
                        <input type="text" class="form-control" id="keterangan_satuan">
                    </div>
                    <button type="button" class="btn btn-success btn-round" id="add"><i class="fa fa-plus"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="card-box table-responsive">
        <table id="tabel" class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap"
            cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 25%">Nama Satuan</th>
                    <th style="width: 50%">Keterangan Satuan</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" name="tutupModalTambah" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Satuan</label>
                    <input type="text" id="id_satuan">
                    <input type="text" id="nm_satuan" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Keterangan Satuan</label>
                    <textarea id="kt_satuan" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <button class="btn btn-success" onclick="editData()" type="button">Edit Data</button>
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
          url: "{{ url('/api/satuan/datatable') }}",
        },
        columns:[
        {
            data: null,
            render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
          {
            data: 'nama_satuan'
          },
          {
            data:'keterangan_satuan'
          },
          {
            data: null,
            render: function(data, type, row, meta) {
            return "<div>" +
                "<button type='button' onclick='deleted(" + data.id_satuan + ")' class='btn btn-danger'>Hapus</button> | " +
                "<button type='button' onclick='ambilData(" + data.id_satuan + ")' class='btn btn-success'>Edit</button>" +
            "</div>" ;
            }
          }
        ]
      });
    });

    function deleted(id)
    {
        axios.delete('{{url('/api/satuan/remove')}}/'+id)
            .then(function(res){
            var data = res.data
            tables.ajax.reload()
            toastr.info(data.message)
        })
    }

    $('#add').click(function(e){
        e.preventDefault();
        var nama_satuan = $('#nama_satuan').val();
        var keterangan_satuan = $('#keterangan_satuan').val();

        axios.post('{{url('/api/satuan/')}}',{
            nama_satuan: nama_satuan,
            keterangan_satuan: keterangan_satuan
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

    function ambilData(id)
    {
        axios.get('{{url('/api/satuan')}}/'+ id)
        .then(function(res) {
            var isi = res.data
            console.log(isi.data)
            document.getElementById('id_satuan').value=isi.data.id_satuan;
            document.getElementById('nm_satuan').value=isi.data.nama_satuan;
            document.getElementById('kt_satuan').value=isi.data.keterangan_satuan;
            $('#modal').modal('show');
        })
    }

    function editData()
    {
        var id_satuan = document.getElementById('id_satuan').value;
        var nama_satuan = document.getElementById('nm_satuan').value;
        var keterangan_satuan = document.getElementById('kt_satuan').value;
        axios.put('{{url('/api/satuan')}}',{
            'id_satuan':id_satuan,
            'nama_satuan':nama_satuan,
            'keterangan_satuan':keterangan_satuan
        }).then(function(res){
            var data = res.data
            toastr.info(data.message)
            $('#modal').modal('hide')
            tables.ajax.reload()
            bersih()
        })
    }

    function bersih()
    {
        document.getElementById("nama_satuan").value=null;
        document.getElementById("keterangan_satuan").value=null;
    }
</script>
@endsection
