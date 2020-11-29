@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Broken & Exp Movement')
<!-- Page Content -->
@section('content')
<div class="mt-2">
    <div class="x_content">
        <div class="row bg-white p-3 rounded mb-3" style="box-shadow:1px 1px 4px grey;">
            <div class="col-sm-12">
                <div class="col-sm-5">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Movement ID</label>
                            <input type="text" class="form-control" readonly value="{{$invoice}}" id="inv_broken_exp">
                        </div>
                        <div class="form-group">
                            <label for="">Form Warehouse</label>
                            <select name="" id="dari_gudang" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">To Warehouse</label>
                            <select name="" id="menuju_gudang" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Movement Date</label>
                            <input type="date" class="form-control" id="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="">Note</label>
                            <textarea name="" id="note" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Stock ID</label>
                                    <input type="text" class="form-control" readonly id="stok_id">
                                </div>
                                <button type="button" class="btn btn-outline-success" id="CariData">Cari
                                    Data</button>
                                <div class="form-group">
                                    <label for="">Product ID</label>
                                    <input type="text" readonly id="produk_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Product Type</label>
                                    <input type="text" class="form-control" id="produk_type" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Product Brand</label>
                                    <input type="text" class="form-control" id="produk_brand" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" id="produk_nama" readonly>
                                </div>
                            </div>
                            <div class="form-group" id="">
                                <label for="">Quantity</label>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div id="isi1"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div id="isi2"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-success" type="button" id="add"><i class="fa fa-plus"></i>
                                Add To
                                List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-2">
    <div class="x_content">
        <div class="row bg-white p-3 rounded mb-3" style="box-shadow:1px 1px 4px grey;">
            <div class="col-sm-12">
                <div class="card-box table-responsive" id="isitabelkeranjang">

                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-outline-info"><i class="fa fa-save"></i> Save</button>
</div>
<!-- Modal -->
<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Warehouse</label>
                            <input type="text" class="form-control" readonly id="warehouse_name">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STOCK ID</th>
                            <th>PRODUCT NAME</th>
                            <th>QUANTITY</th>
                            <th>CAPITAL PRICE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockid as $stok)
                        <tr>
                            <td>{{$stok->stok_id}}</td>
                            <td>{{$stok->produk_nama}}</td>
                            <td>{{$stok->jumlah}}</td>
                            <td>{{$stok->capital_price}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#isitabelkeranjang').load('{{ route('datatablesbem')}}')
    });

    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    var warehouse_asal = [];
    $('#tanggal').val(today)

    var dari_gudang = null;
    var menuju_gudang = null;
    var data_gudang = null;

    // $(document).ready(function(){
    //   tables = $('#tabel').DataTable({
    //     processing : true,
    //     serverSide : true,
    //     ajax:{
    //       url: "{{ url('/api/stok/datatable') }}",
    //     },
    //     columns:[
    //     {
    //         data: null,
    //         render: function(data, type, row, meta) {
    //         return meta.row + meta.settings._iDisplayStart + 1;
    //         }
    //     },
    //       {
    //         data: 'produk_nama'
    //       },
    //       {
    //         data: 'jumlah'
    //       },
    //       {
    //         data: null,
    //         render: function(data, type, row, meta) {
    //         return convertToRupiah(data.capital_price);
    //         }
    //       },
    //       {
    //         data: null,
    //         render: function(data, type, row, meta) {
    //         return "<div>" +
    //             "<button type='button' onclick='pilihData(" + data.produk_id + ")' class='btn btn-success'>Pilih</button>" +
    //         "</div>" ;
    //         }
    //       }
    //     ]
    //   });
    // });


    function tampilGudangAsal(data)
    {
        document.getElementById("dari_gudang").innerHTML = "<option value='0'>-- Pilih Gudang --</option>"
        warehouse_asal = [
            {
                id_gudang: 0,
                nama_gudang: "-- Pilih Gudang --"
            }
        ]

        for(var x = 0; x < data.length; x++)
        {
            warehouse_asal.push({id_gudang: data[x].id_gudang, nama_gudang: data[x].nama_gudang})
            document.getElementById("dari_gudang").innerHTML += "<option value='" + data[x].id_gudang + "'>" + data[x].nama_gudang + "</option>"
        }
    }

    function tampilGudangTujuan()
    {
        var id_gudang_asal = document.getElementById("dari_gudang").value;
        var nama_gudang_asal = document.getElementById("dari_gudang").value;
        document.getElementById("menuju_gudang").innerHTML = "";
        if(id_gudang_asal != "0")
        {
            for(var x = 0; x < warehouse_asal.length; x++)
            {
                if(warehouse_asal[x].id_gudang != id_gudang_asal && id_gudang_asal != "0")
                {
                    document.getElementById("menuju_gudang").innerHTML += "<option value='" + warehouse_asal[x].id_gudang + "'>" + warehouse_asal[x].nama_gudang + "</option>";
                }
            }
        }
    }

    function tampilListStok(id_gudang)
    {
        $("#modalData").modal("show");
        document.getElementById("warehouse_name").value = warehouse_asal[document.getElementById("dari_gudang").selectedIndex].nama_gudang
    }

    function ambilDataGudang()
    {
        document.getElementById("dari_gudang").innerHTML = "<option value=''>-- Pilih Gudang --</option>";
        axios.get('{{url('api/gudang/')}}')
            .then(function(res){
                tampilGudangAsal(res.data.data);
            })
    }

    function pilihData(id,jumlah)
    {
        axios.get('{{url('/api/ambildatastok')}}/'+ id)
        .then(function(res){
            var data = res.data.data
            console.log(data);
            // stok(data.produk_id,data.jumlah)
            $('#stok_id').val(data[0].stok_id)
            $('#produk_id').val(data[0].produk_id)
            $('#produk_nama').val(data[0].produk_nama)
            $('#produk_brand').val(data[0].produk_brand)
            $('#produk_type').val(data[0].nama_type_produk)
        })

        axios.post('{{url('/api/cekdatastok')}}',{
            'produk_id':id
        }).then(function(res){
            var data = res.data.data
            var total = data.length
            if(total == 1)
            {
                var isi = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[0].default_value) +"' class='form-control' id='stok1'>"+
                        "<input readonly type='hidden' value='"+data[0].unit+"' class='form-control' id='unit1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"
                var isi1 = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"

            }
            else if(total == 2)
            {
                var isi = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[0].default_value)+"' class='form-control' id='stok1'>"+
                        "<input readonly type='hidden' value='"+data[0].unit+"' class='form-control' id='unit1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[1].default_value)+"' class='form-control' id='stok2'>"+
                        "<input readonly type='hidden' value='"+data[1].unit+"' class='form-control' id='unit2'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[1].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"
                var isi1 = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah2'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[1].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"
            }
            else if(total == 3)
            {
                var isi = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[0].default_value)+"' class='form-control' id='stok1'>"+
                        "<input readonly type='hidden' value='"+data[0].unit+"' class='form-control' id='unit1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[1].default_value)+"' class='form-control' id='stok2'>"+
                        "<input readonly type='hidden' value='"+data[1].unit+"' class='form-control' id='unit2'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[1].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+ parseInt(data[2].default_value)+"' class='form-control' id='stok3'>"+
                        "<input readonly type='hidden' value='"+data[2].unit+"' class='form-control' id='unit3'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[2].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"
                var isi1 = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah2'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[1].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input type='text' class='form-control' id='jumlah3'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[2].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"
            }
            $('#count').val(total)
            $('#isi1').html(isi)
            $('#isi2').html(isi1)

        }).catch(function(err){
            console.log(err)
        })
    }

    function cekdatastok(id, jumlah)
    {

    }

    document.getElementById('dari_gudang').addEventListener("change", tampilGudangTujuan);
    document.getElementById('CariData').addEventListener("click", tampilListStok);
    ambilDataGudang()
</script>
@endsection
