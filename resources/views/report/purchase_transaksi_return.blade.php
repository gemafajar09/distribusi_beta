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
        <div class="mt-2 mb-2">
<button id="close" class="btn btn-danger btn-sm">Close</button> <button id="print" class="btn btn-dark btn-sm">Print</button>
        </div>
        <div class="text-center">
            <h3>Prototipe Bukti Purchase Order Return</h3>
            <h4>Mediatama Web Indonesia</h4>
        </div>
        <br>
<table class="table" style="border: 2px solid black;">
    <thead>
        <tr>
            <td>Stok ID</td>
            <td>Produk ID</td>
            <td>Produk Nama</td>
            <td>Return Date</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Note Return</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datatmp as $d)
        <tr>
            <td>{{$d['stok_id']}}</td>
            <td>{{$d['produk_id']}}</td>
            <td>{{$d['produk_nama']}}</td>
            <td>{{$d['return_date']}}</td>
            <td>{{$d['stok_quantity']}}</td>
            <td>{{$d['price']}}</td>
            <td>@if($d['note_return'] == 1)
                    {{"Broken Product"}}
                @elseif($d['note_return']==2)
                    {{"Expired Product"}}
                @elseif($d['note_return']==3)
                    {{"Mismatch Order Product"}}
                @elseif($d['note_return']==4)
                    {{"Unsold Product"}}
                @else {{"Other"}}
                @endif
            </td>
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
            $('#print').on('click',function(){
                $("#print").hide();
                $("#close").hide();
                window.print();
                $("#print").show();
                $("#close").show();
            });
            $('#close').on('click',function(){
        
                window.close();
                
            });
    });
    </script>
</body>
</html>