<style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
</style>
<table class="table">
    <thead>
        <tr>
            <th>Invoice Id</th>
            <th>Invoice Date</th>
            <th>Customer Name</th>
            <th>Salesman</th>
            <th>Total Credit Balance</th>
            <th>Total Payment</th>
            <th>Remainening Credit</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasil as $a)
        <tr onclick="cekpayment('{{$a['invoice_id']}}')">
            <td>{{$a['invoice_id']}}</td>
            <td>{{$a['invoice_date']}}</td>
            <td>{{$a['nama_customer']}}</td>
            <td>{{$a['nama_sales']}}</td>
            <td>Rp.{{number_format($a['totalsales'])}}</td>
            <td>Rp.{{number_format($a['payment'])}}</td>
            <td>{{$a['remaining']}}</td>
            <td>{{$a['term_until']}}</td>
            <td>{{$a['status']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div id="payments" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="tab">
                    <button class="tablinks" onclick="openlink(event, 'Credit')">Credit Info</button>
                    <button class="tablinks" onclick="openlink(event, 'Payment')">Payment Detail</button>
                </div>

                <div id="Credit" class="tabcontent">
                    <div class="row">
                        <div class="col-md-3"><b>Credit ID</b></div>
                        <div class="col-md-3"><input type="text" id="creditid" readonly class="form-control"></div>
                        <div class="col-md-3"><b>Sales Invoice</b></div>
                        <div class="col-md-3"><input type="text" id="invoicesales" readonly class="form-control"></div>
                        <div class="col-md-3"><b>Credit Amount</b></div>
                        <div class="col-md-3"><input type="text" id="creditamount" readonly class="form-control"></div>
                        <div class="col-md-3"><b>Due Date</b></div>
                        <div class="col-md-3"><input type="text" id="duedate" readonly class="form-control"></div>
                        <div class="col-md-3"><b>Remaining Credit Amount</b></div>
                        <div class="col-md-3"><input type="text" id="remaining" readonly class="form-control"></div>
                        <div class="col-md-3"><b>Customer Name</b></div>
                        <div class="col-md-3"><input type="text" id="customers" readonly class="form-control"></div>
                        <div class="col-md-12">
                            <input type="radio" name="radio" id="changedue" onclick="getdue()">&nbsp; Change Due Date <br>
                            <input type="radio" name="radio" id="getpayment" onclick="getpay()">&nbsp; Get Payment
                            <!--  -->
                            <div class="form-group" style="display: none;" id="gets">
                                <label for="">Payment Amount</label><br>
                                <input type="radio" name="cash" id="cash" onclick="bayarcash()">&nbsp;Cash
                                <input type="radio" name="cash" id="cash" onclick="bayartransfer()">&nbsp;Transfer
                                <input type="text" id="amountss" class="form-control">
                                <input type="hidden" id="statuss">
                            </div>
                            <br>
                            <div>
                                <button type="button" class="btn btn-outline-success" id="pay"><i class="fa fa-pay">Get Payment</i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Payment" class="tabcontent">

                </div>

            </div>
        </div>

    </div>
</div>

<script>
    // new AutoNumeric('#amountss', {
    //     currencySymbol : 'Rp.',
    //     decimalCharacter : ',',
    //     digitGroupSeparator : '.',
    // });

    $('#pay').click(function(){
        var invoice_credit = $('#creditid').val()
        var invoice_id = $('#invoicesales').val()
        var payment = $('#amountss').val()
        var status = $('#statuss').val()
        axios.post("{{url('/api/addpayment')}}",{
            'payment_id':invoice_credit,
            'invoice_id':invoice_id,
            'payment':payment,
            'status':status
        }).then(function(res){
            var data = res.data
            location.reload()
        })
    })

    function bayarcash()
    {
        $('#statuss').val('Cash')
    }

    function bayartransfer()
    {
        $('#statuss').val('Transfer')
    }

    function getdue() {
        var ceks = document.getElementById('changedue').checked;
        if (ceks == true) {
            $('#gets').hide()
        } else {
            $('#gets').show()
        }
    }

    function getpay() {
        var ceks = document.getElementById('getpayment').checked;
        if (ceks == true) {
            $('#gets').show()
        } else {
            $('#gets').hide()
        }
    }

    function openlink(evt, tabactif) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabactif).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function cekpayment(id) {
        var id_user = $('#id_suer').val()
        axios.post("{{url('/api/detailtrans')}}", {
            'id_transaksi': id
        }).then(function(res) {
            var data = res.data
            credit(id, id_user)
            $('#detailcredit').html(data)
            $('#payments').modal()
        })
    }

    function credit(id, id_user) {
        axios.post("{{url('/api/getcredit')}}", {
            'id_transkasi': id,
            'id_user': id_user
        }).then(function(res) {
            var data = res.data.data
            if (res.data.status == 200) {
                $('#creditid').val(res.data.invoice)
                $('#invoicesales').val(data.invoice_id)
                $('#creditamount').val(convertToRupiah(data.totalsales))
                $('#duedate').val(data.term_until)
                $('#remaining').val(convertToRupiah(data.totalsales))
                $('#customers').val(data.nama_customer)
            }
        })
    }
</script>