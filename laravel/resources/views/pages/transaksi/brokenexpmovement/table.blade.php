<table class="table table-striped table-responsive-sm table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>STOCK ID</th>
            <th>PRODUCT ID</th>
            <th>PRODUCT TYPE</th>
            <th>PRODUCT BRAND</th>
            <th>PRODUCT NAME</th>
            <th>Quantity</th>
            <th>Aksi</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($init as $dt)
        <tr>
            <td>{{$dt['stok_id']}}</td>
            <td>{{$dt['produk_id']}}</td>
            <td>{{$dt['nama_type_produk']}}</td>
            <td>{{$dt['produk_brand']}}</td>
            <td>{{$dt['produk_nama']}}</td>
            <td>{{$dt['quantity']}}</td>
            <td><button id="" onclick="deletes('{{$dt['id_broken_exp_tmp']}}')" class="btn btn-outline-danger btn-sm"><i
                        class="fa fa-trash"></i></button></td>
        </tr>
        @endforeach
    </tbody>
</table>
