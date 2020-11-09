@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Cost')
<!-- Page Content -->
@section('content')
<h1>Welcome Cost</h1>
<div class="mt-2">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <button type="button" class="btn btn-round btn-success btn-clipboard" data-toggle="modal"><i
                            class="fa fa-plus" onclick="tampilModal()"></i></button>
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sales</th>
                                <th>Tanggal</th>
                                <th>Nama Cost</th>
                                <th>Nominal</th>
                                <th>Note</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button> | <button
                                        class="btn btn-warning"><i class="fa fa-edit" onclick="edit()"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalCost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i>Data Cost</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama Sales</label>
                    <select name="" id="" class="form-control">
                        <option value="">Test</option>
                        <option value="">Test</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nama Cost</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form">
                    <label for="">Nominal</label>
                    <input type="number" class="form-control">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="">Note</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="Simpan" onclick="simpan()" type="button">Simpan Data</button>
                <button class="btn btn-warning" id="Update" onclick="update()" type="button">Update Data</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function tampilModal(){
        $('#Simpan').css('display', 'block');
        $('#Update').css('display', 'none');
        $('#modalCost').modal()
    }

    function edit() {
        $('#Simpan').css('display', 'none');
        $('#Update').css('display', 'block');
        $('#modalCost').modal('show');
    }
</script>
