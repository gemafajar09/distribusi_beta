<table class="table">
    <thead>
        <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Grand Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detail as $b)
        <tr>
            <td>{{$b['produk_id']}}</td>
            <td>{{$b['produk_nama']}}</td>
            <td>{{$b['quantity']}}</td>
            <td>{{$b['produk_harga']}}</td>
            <td>{{$b['diskon']}}</td>
            <td>Rp.{{number_format($b['amount'])}}</td>
        </tr>
        @endforeach
    </tbody>
</table>