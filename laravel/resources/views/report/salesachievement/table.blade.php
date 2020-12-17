<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<table id="myTable" class="table table-striped table-bordered" id="tabelsatu" width="100%">
    <thead>
        <tr>
            <th>INVOICE ID</th>
            <th>INVOICE DATE</th>
            <th>INVOICE TYPE</th>
            <th>CUSTOMER NAME</th>
            <th>TOTAL</th>
            <th>DISCOUT</th>
            <th>DP</th>
            <th>TOTAL AFTER DISCOUNT</th>
            <th>PAY STATUS</th>
            <th>TRANSACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->invoice_id}}</td>
            <td>{{$d->invoice_date}}</td>
            <td>{{$d->transaksi_tipe}}</td>
            <td>{{$d->nama_customer}}</td>
            <td>{{$d->totalsales}}</td>
            <td>{{$d->diskon}}</td>
            <td>{{$d->dp}}</td>
            <td></td>
            <td>{{$d->status}}</td>
            <td>{{$d->sales_type}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>