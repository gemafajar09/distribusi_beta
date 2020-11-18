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
                                        <input type="text" style="border-radius:3px; font-size:12px" name="invoiceid" value="TOVS-{{date('Ym')}}-{{session()->get('id')}}" readonly class="form-control">
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
                        <div class="col-md-3 col-sm-4 col-lg-2 col-xl-2">
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
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control" id="">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Box</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control" id="">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Cup</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input  type="text" class="form-control" id="">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Box</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input  type="text" class="form-control" id="">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Cup</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Price</div>
                                                </div>
                                                <input type="text" class="form-control" id="">
                                            </div>
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
            $('#produkid').val(data[0].produk_id)
            $('#produktype').val(data[0].nama_type_produk)
            $('#produkbrand').val(data[0].produk_brand)
            $('#produknama').val(data[0].produk_nama)
        }).catch(function(err){
            console.log(err)
        })
    })
</script>
@endsection