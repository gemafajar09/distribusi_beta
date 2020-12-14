<table id="datatable-keytable" class="table table-striped table-bordered" style="width:100%; font-size:11px">
    <thead>
        <tr style="text-align: center; font-size:10px">
            <th style="width: 10px;">No</th>
            <th>STOCK ID</th>
            <th>PRODUCT ID</th>
            <th>PRODUCT TYPE</th>
            <th>PRODUCT BRAND</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
            <th>Quantity</th>
            <th>TOTAL</th>
            <th>DISCOUNT</th>
            <th>AMOUNT</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        @foreach($init as $i => $a)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$a['nama_customer']}}</td>
            <td>{{$a['invoice_id']}}</td>
            <td>{{$a['transaksi_tipe']}}</td>
            <td>{{$a['invoice_date']}}</td>
            <td>{{$a['term_until']}}</td>
            <td>{{$a['nama_sales']}}</td>
            <td>Rp.{{number_format($a['totalsales'])}}</td>
            <td>Rp.{{number_format($a['diskon'])}}</td>
            <td>Rp.{{number_format($a['dp'])}}</td>
            <td>{{$a['status']}}</td>
            <td style="text-align: center;">
                <button id="" onclick="details()" class="btn btn-outline-success btn-sm"><i
                        class="fa fa-info"></i></button>
                <button onclick="cetak('{{$a['invoice_id']}}','{{$a['transaksi_tipe']}}','{{$a['id_cabang']}}')"
                    class="btn btn-outline-danger btn-sm"><i class="fa fa-print"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{-- <input type="hidden" id="totalss" value="{{$total}}"> --}}
<script>
    function cetak(invoice_id,salestype,id_cabang)
    {
        window.open("{{url('/sales_transaksi/fakturs')}}/" + invoice_id + "/" + salestype + "/" + id_cabang,
                            '_blank');
    }

    // var total = $('#totalss').val()
    // $('#terbilang').html(terbilang(total) + ' Rupiah')
    // $('#totalsales').val(convertToRupiah(total))
    // $('#afterdiscount').val(convertToRupiah(total))
    // $('#creditbalance').val(convertToRupiah(total))

    
    // function deletes(id_transksi)
    // {
    //     axios.post('{{url('/api/deleteitem')}}',{
    //         'id_transksi':id_transksi
    //     }).then(function(res){
    //         var data = res.data
    //         if(data.status == 200)
    //         {
    //             $('#isibody').load("{{ route('datatablessales')}}")
    //         }
    //     })
    // }
</script>