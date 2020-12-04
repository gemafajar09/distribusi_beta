<table class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <div class="col-sm-4 mb-2">
    </div>
    <thead>
        <tr>
            <th style="width: 5%">Stok ID</th>
            <th>Produk Nama</th>
            <th>Stock Ammount</th>
            <th>Capital Price</th>
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
