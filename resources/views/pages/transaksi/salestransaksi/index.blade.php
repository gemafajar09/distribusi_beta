@extends('layout.index')

@section('page-title','Sales Trasaction')
@section('content')

<div class="row">
    <div class="col-md-12" id="entrySales">
        <div class="card">
            <form action="" method="POST">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Sales Type</label>
                                        <select name="salesType" id="salesType" class="select2" style="width:100%">
                                            <option value="">SALES TYPE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Invoice ID</label>
                                        <input type="text" style="border-radius:3px; font-size:12px" id="invoiceid" name="invoiceid" value="{{$invoice}}" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Invoice Date</label>
                                        <input type="date" style="border-radius:3px" name="invoiceDate" placeholder="invoiceDate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Transaction Type</label><br>
                                        <input type="radio" style="border-radius:3px" name="transType" placeholder="transType"> <b>Cash</b>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" style="border-radius:3px" name="transType" placeholder="transType"> <b>Credit</b>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Term Until</label>
                                        <input type="date" style="border-radius:3px" name="invoiceDate" placeholder="invoiceDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Salesman ID</label>
                                        <select name="salesmanId" id="salesmanId" class="select2" style="width:100%">
                                            <option value="">Sales ID</option>
                                            @foreach($salesid as $i => $sales):
                                                <option value="{{$sales->id_sales}}">{{$sales->id_sales}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Salesman Nama</label>
                                        <input type="text" readonly style="border-radius:3px" class="form-control" name="namaSales" id="namasales">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Customer ID</label>
                                        <select name="customerid" id="customerid" class="select2" style="width:100%">
                                            <option value="">Customer ID</option>
                                            @foreach($customerid as $i => $customer):
                                                <option value="{{$customer->id_customer}}">{{$customer->id_customer}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Customer Nama</label>
                                        <input type="text" readonly style="border-radius:3px" class="form-control" name="namacustomer" id="namacustomer">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Note</label>
                                    <textarea name="" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Stok ID</label>
                                        <select name="stockId" id="stockId" class="select2" style="width:100%">
                                            <option value="">STOCK ID</option>
                                            @foreach($stockid as $a)
                                                <option value="{{$a->produk_id}}">{{$a->produk_id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product ID</label>
                                        <input type="text" style="border-radius:3px" id="produkid" name="produkid" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Type</label>
                                        <input type="text" style="border-radius:3px" id="produktype" name="produktype" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Brand</label>
                                        <input type="text" style="border-radius:3px" id="produkbrand" name="produkbrand" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <input type="text" style="border-radius:3px" id="produknama" name="produknama" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-5">
                            <div class="card">
                                <div class="card-body">
                                    <b>Quantity</b>
                                    <hr>
                                    <div class="row">
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
                                        
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Price</div>
                                                </div>
                                                <input type="text" class="form-control" id="prices">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Discount</div>
                                                </div>
                                                <input type="text" class="form-control" id="discount">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">%</div>
                                                </div>
                                                <div class="input-group-prepend">
                                                    <input type="text" class="form-control" id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="count">
                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6" align="center">
                                            <button type="button" style="width:140px;" id="add" class="btn btn-outline-success">Add</button>
                                        </div>
                                        <div class="col-md-6" align="center">
                                            <button type="button" style="width:140px;" class="btn btn-outline-danger">Remove All</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STOCK ID</th>
                                    <th>PRODUCT ID</th>
                                    <th>PRODUCT TYPE</th>
                                    <th>PRODUCT BRAND</th>
                                    <th>PRODUCT NAME</th>
                                    <th>PRICE</th>
                                    <th>UNIT I</th>
                                    <th>UNIT II</th>
                                    <th>UNIT III</th>
                                    <th>TOTAL</th>
                                    <th>DISCOUNT</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody id="isibody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function show()
    {
        $('#entry').modal()
    }

    $('#add').click(function(){
        var invoiceid = $('#invoiceid').val()
        var stockId = $('#stockId').val()
        var produkid = $('#produkid').val()
        var produktype = $('#produktype').val()
        var produkbrand = $('#produkbrand').val()
        var produknama = $('#produknama').val()
        var prices = $('#prices').val()
        // cek diskon kosong atau tidak
        var discount = $('#discount').val()
        if(discount == '')
        {
            var disc = 0
        }else{
            var disc = discount
        }
        // cek amount
        var amou = $('#amount').val()
        if(amou == '')
        {
            var amount = 0
        }else{
            var amount = amou
        }
        // hitung jumlah
        var count = parseInt($('#count').val())
        if(count == 1)
        {
            var jumlah1 = $('#jumlah1').val()
            var uni1 = $('#uni1').val()
        }
        else if(count == 2)
        {
            var jumlah1 = $('#jumlah1').val()
            var uni1 = $('#uni1').val()
            var jumlah2 = $('#jumlah2').val()
            var uni2 = $('#uni2').val()
        }
        else if(count == 3)
        {
            var jumlah1 = $('#jumlah1').val()
            var uni1 = $('#uni1').val()
            var jumlah2 = $('#jumlah2').val()
            var uni2 = $('#uni2').val()
            var jumlah3 = $('#jumlah3').val()
            var uni3 = $('#uni3').val()
        }
        axios.post('{{url('/api/addkeranjang')}}',{
            'invoiceid':invoiceid,
            'stockId':stockId,
            'produkid':produkid,
            'prices':prices,
            'disc':disc,
            'amount':amount,
        })
    })

    $('#salesmanId').change(function(){
        var salesid = $(this).val()

        axios.post('{{url('/api/getsalestrans')}}',{
            'sales_id': salesid
        }).then(function(res){
            var data = res.data.data
            console.log(data.nama_sales)
            $('#namasales').val(data.nama_sales)
        }).catch(function(err){
            console.log(err)
        })
    })

    $('#customerid').change(function(){
        var customerid = $(this).val()

        axios.post('{{url('/api/getCustomer')}}',{
            'customer_id': customerid
        }).then(function(res){
            var data = res.data.data
            $('#namacustomer').val(data.nama_customer)
        }).catch(function(err){
            console.log(err)
        })
    })

    $('#stockId').change(function(){
        var stokid = $(this).val()

        axios.post('{{url('/api/getProduk')}}',{
            'produk_id': stokid,
            'cabang': '{{session()->get('cabang')}}'
        }).then(function(res){
            var data = res.data.data
            console.log(data)
            stok(data.produk_id,data.jumlah)
            $('#produkid').val(data.produk_id)
            $('#produktype').val(data.nama_type_produk)
            $('#produkbrand').val(data.produk_brand)
            $('#produknama').val(data.produk_nama)
            $('#prices').val(convertToRupiah(data.produk_harga))
        }).catch(function(err){
            console.log(err)
        })
    })

    function stok(id, jumlah)
    {
        axios.post('{{url('/api/cekstok')}}',{
            'produk_id':id
        }).then(function(res){
            var data = res.data.data
            var total = data.length
            if(total == 1)
            {
                var isi = "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[0].default_value) +"' class='form-control' id='stok1'>"+
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
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[0].default_value)+"' class='form-control' id='stok1'>"+
                        "<input readonly type='hidden' value='"+data[0].unit+"' class='form-control' id='unit1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[1].default_value)+"' class='form-control' id='stok2'>"+
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
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[0].default_value)+"' class='form-control' id='stok1'>"+
                        "<input readonly type='hidden' value='"+data[0].unit+"' class='form-control' id='unit1'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[0].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[1].default_value)+"' class='form-control' id='stok2'>"+
                        "<input readonly type='hidden' value='"+data[1].unit+"' class='form-control' id='unit2'>"+
                        "<div class='input-group-prepend'>"+
                            "<div class='input-group-text'>"+data[1].unit+"</div>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='input-group'>"+
                        "<input readonly type='text' value='"+parseInt(jumlah) * parseInt(data[2].default_value)+"' class='form-control' id='stok3'>"+
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
</script>
@endsection