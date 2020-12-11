@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Aproval Sales Transaction')
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
                    <th>Invoice ID</th>
                    <th>Invoice Date</th>
                    <th>Nama Sales</th>
                    <th>Total</th>
                    <th>Diskon</th>
                    <th>Aproval</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $a)
                <tr>
                    <td>{{$a->invoice_id}}</td>
                    <td>{{$a->invoice_date}}</td>
                    <td>{{$a->nama_sales}}</td>
                    <td>Rp.{{number_format($a->totalsales)}}</td>
                    <td>Rp.{{number_format($a->diskon)}}</td>
                    <td>
                        <select name="aproves" id="aproves" class="form-control">
                            <option value="">-SELECT-</option>
                            <option value="1">Approve</option>
                            <option value="2">Disapprove</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <button onclick="approves('{{$a->id_transaksi_sales}}','{{$a->invoice_id}}')" class="btn btn-outline-success">Approve</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <button onclick="register()" class="btn btn-danger btn-sm">Register Transaksi</button> -->
        
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-minus"></i> Detail Purchase</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td>Produk Nama</td>
                      <td>Quantity</td>
                      <td>Price</td>
                    </tr>
                  </thead>
                  <tbody id="detailinvoice">

                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function approves(id,invoice)
    {
        var status = $('#aproves').val()
        axios.post("{{url('/api/approval')}}",{
            'id_transaksi':id,
            'status':status,
            'invoice_id':invoice
        }).then(function(res){
            window.location.reload()
        })
    }

    function refresh(){
        window.location.reload()
    }
</script>

@endsection
