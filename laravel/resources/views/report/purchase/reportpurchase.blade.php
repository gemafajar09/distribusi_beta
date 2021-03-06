<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset('/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
        <div class="text-center">
            <h4>Report Purchase</h4>
            <h5>SUMBER CAHAYA REZEKI</h5>
            <h6>Jl. BY PASS TALUAK BUKITTINGGI, INDONESIA</h6>
            <H6>PHONE : 085375715757 FAX : (0752) 8810863</H6>
            <hr style="border:2px solid black;">
        </div>
        </div>
        </div>
        
    <table border="2" id="tabel"  style="border: 2px solid black; width:100%;">
    <thead>
    <tr>
                   <th>Invoice ID</th>
                   <th>Invoice Date</th>
                   <th>Type</th>
                   <th>Total</th>
                   <th>Diskon</th>
                   <th>Bayar</th>
                   <th>Total After Diskon</th>
                   <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataisi as $d)
                <tr>
                   <td>{{$d['invoice_id']}}</td>
                   <td>{{$d['invoice_date']}}</td>
                   <td>{{$d['transaksi_tipe']}}</td>
                   <td>{{$d['total']}}</td>
                   <td>{{$d['diskon']}}</td>
                   <td>{{$d['bayar']}}</td>
                   <td>{{$d['sisa']}}</td>
                   <td>{{$d['status']}}</td>
                </tr>
                @endforeach
            </tbody>
    </table>
    
</div>

    
<!-- script -->
<script src="{{asset('/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script>
        $( document ).ready(function() {
            window.print();   
    });
    </script>
</body>
</html>