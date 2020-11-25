<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{asset('/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td><b>SUMBER CAHAYA REZEKI</b></td>
                    </tr>
                    <tr>
                        <td>JL. BY PASS TALUAK</td>
                    </tr>
                    <tr>
                        <td>BUKITTINGGI, INDONESIA</td>
                    </tr>
                    <tr>
                        <td>PHONE : 085375715757 FAX : (0752) 8810863</td>
                    </tr>
                </table>
                <table style="border:1px solid black; width:100%">
                    <tr>
                        <td>Bill To :</td>
                    </tr>
                    <tr>
                        <td>{{$sales->nama_customer}}</td>
                    </tr>
                    <tr>
                        <td>{{$sales->nama_perusahaan}}</td>
                    </tr>
                    <tr>
                        <td>{{$sales->alamat}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4 offset-4 text-center">
                <b>SALES INVOICE</b>
                <hr>
                <p>Invoice ID : {{$inv}}</p>
                <table style="border:1px solid grey; width:100%">
                    <tr>
                        <td style="width:80px">Invoice Date</td>
                        <td style="width:80px">Invoice Type</td>
                    </tr>
                    <tr>
                        <td style="width:80px">{{$sales->invoice_date}}</td>
                        <td style="width:80px">{{$sales->transaksi_tipe}}</td>
                    </tr>
                </table>
                <table style="border:1px solid grey; width:100%">
                    <tr>
                        <td style="width:80px">Salesman</td>
                        <td style="width:80px">Term</td>
                    </tr>
                    <tr>
                        <td style="width:80px">{{$sales->nama_sales}}</td>
                        <td style="width:80px">{{$sales->term_until}}</td>
                    </tr>
                </table>
                <table style="border:1px solid grey; width:100%">
                    <tr>
                        <td style="width:80px">Warehouse</td>
                    </tr>
                    <tr>
                        <td style="width:80px">Gudang Utama</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Amount</th>
                    </tr>
                    @foreach($init as $a)
                    <tr>
                        <td>{{$a['produk_nama']}}</td>
                        <td>{{$a['quantity']}}</td>
                        <td>{{$a['produk_harga']}}</td>
                        <td>{{$a['total']}}</td>
                        <td>{{$a['diskon']}}</td>
                        <td>{{number_format($a['amount'])}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-8">
                <p>Note : {{$sales->catatan}}</p>
                <hr style="border:2px solid black">
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Prepared By</b></p>
                        <br>
                        {{Session()->get('nama')}}
                        <br>
                        -----------------
                        <p style="font-size: 10px;">Date : {{date('Y-m-d')}}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Approved By</b></p>
                        <br><br>
                        -----------------
                        <p style="font-size: 10px;">Date :</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Received By</b></p>
                        <br><br>
                        -----------------
                        <p style="font-size: 10px;">Date :</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <table style="border:1px solid black; width:100%;">
                    <tr>
                        <td>Total Sales</td>
                        <td style="text-align: right;">Rp. {{number_format($sales->totalsales)}}</td>
                    </tr>
                    <tr>
                        <td>Final Discount</td>
                        <td style="text-align: right;">{{$sales->diskon}}</td>
                    </tr>
                    <tr>
                        <td>Total After Discount</td>
                        <td style="text-align: right;" id="afterdiskon"></td>
                    </tr>
                    <tr>
                        <td>Down Payment</td>
                        <td style="text-align: right;" id="downpay"></td>
                    </tr>
                    <tr>
                        <td>Total Credit Balance</td>
                        <td style="text-align: right;" id="totalcredit"></td>
                    </tr>
                </table>
                <input type="hidden" id="totalsales" value="{{$sales->totalsales}}">
                <input type="hidden" id="diskon" value="{{$sales->diskon}}">
            </div>
        </div>
    </div>
    <script src="{{asset('/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script>
        function convertToRupiah(angka)
        {
            var rupiah = '';		
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }

        $(document).ready(function(){
            var total = $('#totalsales').val()
            var diskon = $('#diskon').val()
            var hasil = total - diskon
            $('#afterdiskon').html(convertToRupiah(hasil))
            $('#downpay').html(diskon)
            $('#totalcredit').html(convertToRupiah(hasil))

            window.print()
        })
    </script>
</body>

</html>