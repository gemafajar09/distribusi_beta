@extends('layout.index')

@section('page-title','Return Sales Trasaction')
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
                                        <label for="">Sales Return ID</label>
                                        <input type="text" style="border-radius:3px; font-size:12px" id="invoiceid"
                                            name="invoiceid" value="{{$inv}}" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Return Date</label>
                                        <input type="date" style="border-radius:3px" name="invoiceDate" id="invoiceDate"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Compensation</label><br>
                                        <select name="compensation" id="compensation" class="form-control">
                                            <option value="">-SELECT-</option>
                                            <option value="CASH">CASH</option>
                                            <option value="TERM UNTIL">TERM UNTIL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="termutil" style="display: none;">
                                    <div class="form-group">
                                        <label for="">Term Until</label>
                                        <input type="date" value="{{date('Y-m-d')}}" style="border-radius:3px"
                                            id="term_util" name="term_util"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-2">
                            <div class="row">
                                <div class="col-md-12" id="warehouse">
                                    <div class="form-group">
                                        <label for="">Sales Invoice ID</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="idsalesinv" id="idsalesinv">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" onclick="serch()" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="tampilsales">
                                    <div class="form-group">
                                        <label for="">Salesman ID</label>
                                        <input type="text" class="form-control" style="border-radius:3px" readonly id="invdate">
                                    </div>
                                </div>
                                <div class="col-md-12" id="tampilsales1">
                                    <div class="form-group">
                                        <label for="">Invoice Type</label>
                                        <input type="text" readonly style="border-radius:3px" class="form-control"
                                            name="invtype" id="invtype">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Customer ID</label>
                                        <input type="text" class="form-control" style="border-radius:3px"  readonly id="invdate">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Customer Nama</label>
                                        <input type="text" readonly style="border-radius:3px" class="form-control"
                                            name="namacustomer" id="namacustomer">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Pay Status</label>
                                    <input name="" id="note" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Stok To Return</label>
                                        <select name="stockId" id="stockId" class="select2" style="width:100%">
                                            <option value="">STOCK ID</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Type</label>
                                        <input type="text" style="border-radius:3px" id="produktype" name="produktype"
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Brand</label>
                                        <input type="text" style="border-radius:3px" id="produkbrand" name="produkbrand"
                                            readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <input type="text" style="border-radius:3px" id="produknama" name="produknama"
                                            readonly class="form-control">
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
                                                <input type="text" class="form-control" onkeyup="diskon(this)"
                                                    id="discount">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">%</div>
                                                </div>
                                                <div class="input-group-prepend">
                                                    <input type="text" class="form-control" onkeyup="diskon1(this)"
                                                        id="amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6" style="text-align: center;">
                                            <button type="button" style="width:140px;" onclick="add()"
                                                class="btn btn-outline-success">Add</button>
                                        </div>
                                        <div class="col-md-6" style="text-align: center;">
                                            <button type="button" style="width:140px;"
                                                class="btn btn-outline-danger">Remove All</button>
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

                    <div class="card-body" id="isibody"></div>
                    <div>
                        <div class="row" style="margin-left: 10px; margin-right:10px; margin-bottom:10px;">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <table border="0" style="width: 100%;">
                                            <tr>
                                                <td>Total Sales</td>
                                                <td style="width: 10px;">:</td>
                                                <td colspan="3"><input type="text" id="totalsales" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Final Discount</td>
                                                <td style="width: 10px;">:</td>
                                                <td style="width: 60px;"><input onkeyup="disco(this)" id="discon"
                                                        type="text" class="form-control"></td>
                                                <td style="width: 10px;">%</td>
                                                <td><input type="text" id="potongan" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Total After Discount</td>
                                                <td style="width: 10px;">:</td>
                                                <td colspan="3"><input type="text" id="afterdiscount"
                                                        class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Down Payment</td>
                                                <td style="width: 10px;">:</td>
                                                <td colspan="3"><input type="text" id="downpayment"
                                                        class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Credit Balance</td>
                                                <td style="width: 10px;">:</td>
                                                <td colspan="3"><input type="text" id="creditbalance"
                                                        class="form-control"></td>
                                            </tr>
                                        </table>
                                        <input type="hidden" id="metode">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body" style="background-color: grey;">
                                        <h5 style="color: white;" id="terbilang"></h5>
                                    </div>
                                </div>
                                <br>
                                <input type="checkbox" id="print">&nbsp;<i>Print Invoice</i>
                                <br>
                                <button type="button" onclick="register()" class="btn btn-outline-success">Register
                                    Transaction </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="caridata" class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color:grey">
        <h4 class="modal-title" style="color:white" >List Sales Transaction</h4>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="email">View By:</label>
                                <Select class="select2" name="view" id="view" style="width:100%">
                                    <option value="">-SELECT-</option>
                                    <option value="ALL">ALL TRANSACTION</option>
                                    <option value="CANVASING">CANVAS</option>
                                    <option value="TAKING ORDER">TAKING ORDER</option>
                                    <option value="CUSTOMER">CUSTOMER</option>
                                </Select>
                            </div>
                            <div class="checkbox">
                                <label><input style="margin-left:50px" onclick="alls()" type="radio" name="radio"> All Invoice</label>
                            </div>
                            <div class="checkbox">
                                <label><input style="margin-left:50px" type="radio" onclick="range()" name="radio"> Range Invoice</label>
                            </div>
                            <input type="hidden" id="tipe">
                        </form>
                    </div>
                    <div class="col-md-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="email">Search By:</label>
                                <Select class="select2" name="serch" id="serch" style="width:100%">
                                    <option value="">-SELECT-</option>
                                    <option value="ALL">ALL REPORT</option>
                                    <option value="INVOICE ID">INVOICE ID</option>
                                    <option value="INVOICE TYPE">INVOICE TYPE</option>
                                    <option value="SALESMAN">SALESMAN</option>
                                    <option value="CUSTOMER">CUSTOMER</option>
                                </Select>
                            </div>
                            <div class="checkbox">
                                <label>&nbsp;</label>
                                <input style="margin-left:50px" class="form-control" onkeyup="cari1(this)" type="text" name="filter">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 py-3" id="datadicari"></div>
                </div>
            </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
    $('#compensation').change(function(){
        var cek = $(this).val()
        if(cek == 'TERM UNTIL')
        {
            $('#termutil').show()
        }else{
            $('#termutil').hide()
        }
    })

    function alls()
    {
        $('#tipe').val('all')
    }

    function range()
    {
        $('#tipe').val('range')
    }

    function serch()
    {
        $('#caridata').modal()
    }

    function cari1(cari)
    {
        var nama = cari.value
        var serch = $('#serch').val()
        var view = $('#view').val()
        var tipe = $('#tipe').val()

        axios.get("{{url('/sales_transaksi/showreturdetail')}}/"+nama+"/"+serch+"/"+view+"/"+tipe).then(function(res){
            var data = res.data
            $('#datadicari').html(data)
        })
    }
</script>
@endsection