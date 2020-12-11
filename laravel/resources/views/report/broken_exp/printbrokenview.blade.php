<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-2">
        <h1>LIST OF STOCK INVENTORY</h1>
        <h1>CV.GEMILANG MITRA SUKSES</h1>
        GADUIK <br>
        AGAM <br>
        HP: 08*********
    </div>
    <table id="table" border=2 style="width: 100%">
        <thead>
            <tr>
                <th scope="col">STOCK ID</th>
                <th scope="col">PRODUCT DESCRIPTION</th>
                <th scope="col">STOCK AMMOUNT</th>
                <th scope="col">CAPITAL PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataisi as $data)
            <tr>
                <td>{{$data['stok_id']}}</td>
                <td>{{$data['produk_nama']}}</td>
                <td>{{$data['jumlah']}}</td>
                <td>{{$data['capital_price']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
