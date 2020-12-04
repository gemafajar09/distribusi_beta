<!-- javascript dulu -->
<a href="#" class="btn btn-success btn-sm" onclick="print_faktur()">Export</a>
<table id="example2" class="table table-bordered" style="width:100%; font-size:11px">
    <thead>
        <tr style="text-align: center; font-size:10px">
            <th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Produk</th>  
            <th style="width:70px;">System Stok</th>
            <th>Fisik Stok</th>
            <th>Unbalance</th>
            <th rowspan="2" align="center" style="vertical-align : middle;text-align:center;">Loss</th>
            <th rowspan="2" class="bg-success"  align="center" style="vertical-align : middle;text-align:center;color:white;width:60px;">Tanggal</th>
            <th rowspan="2" class="bg-success"  align="center" style="vertical-align : middle;text-align:center;width:70px;color:white;">Selisih Terakhir</th>
            <th rowspan="2" class="bg-success"  align="center" style="vertical-align : middle;text-align:center;color:white;width:70px;">Adjust</th>
            <th rowspan="2" class="bg-success" align="center" style="vertical-align : middle;text-align:center;color:white;">Simpan</th>

        </tr>
        <tr>
            <th align="center">Quantity</th>
            <th style="width: 200px;">Quantity</th>
            <th align="center">Quantity</th>
        </tr>
    </thead>
    <tbody>

        <?php $nilai = []; ?>
        @foreach($dataisi as $d)
        <?php $nilai[] = $d; ?>
        <tr>
            <td>{{$d['produk_nama']}}</td>
           
            <td>{{$d['jumlah']}}</td>
            <!-- <td id="{{$d['stok_id']}}"><script>loadinput(`{{$d['produk_id']}}`,`{{$d['stok_id']}}`,`{{$d['capital_price']}}`);</script></td> -->
            <td id="{{$d['stok_id']}}"></td>
            <td></td>
            <td></td>
            <td>
                @if(empty($d['update_opname']))
                {{"Not Update"}}
                @else
                {{$d['update_opname']}}
                @endif
            </td>
            <td>@if(empty($d['selisih']))
                {{"0"}}
                @else
                {{$d['selisih']}}
                @endif</td>
            <td>@if($d['balance']=='0')
                <button class="btn btn-danger btn-sm" onclick="adjustment(`{{$d['id_opname']}}`)">Adjust</button>
                @elseif($d['balance']=='1')
                {{"Balance"}}
                @elseif($d['balance']=='2')
                {{"Waiting Adjust"}}
                @elseif($d['balance']=='3')
                {{"Adjust Reject"}}
                @else
                {{"Not Cek"}}
                @endif
            </td>
            <td><input type="checkbox" onchange="doalert(this,`{{$d['stok_id']}}`,`{{$d['produk_id']}}`)"> Cek</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var data = <?=json_encode($nilai)?>;
        
        for (var i = 0; i < data.length; i++) {
            loadinput(data[i].stok_id, data[i].capital_price)
        }
    })

    function loadinput(urut, capital_price) {
        cabang = {{session()->get('cabang')}}
        axios.get('{{url('/api/getunitopname/')}}/' + urut+'/'+cabang)
            .then(function(res) {
                isi = res.data
                panjang = isi.data.length
                if (panjang == 3) {
                    for (let index = 0; index < panjang; index++) {
                        $('#' + urut).append(`<div class='form-group col-sm-4'><label>${isi.data[index].maximum_unit_name}</label> <input type='number' id='unit${index+1}' value='0' style='width:100%;' onkeyup='cekbalance(${isi.data[index].stok_id},${isi.data[index].produk_id}),${capital_price}'></div> `)
                    }
                } else if (panjang == 2) {
                    $('#' + urut).append(`<input type='hidden' id='unit${1}' value='null'> `)
                    for (let index = 0; index < panjang; index++) {
                        $('#' + urut).append(`<div class='form-group col-sm-4' style='margin-right:10px;'><label>${isi.data[index].maximum_unit_name}</label> <input type='number' id='unit${index+2}' value='0' style='width:100%;' onkeyup='cekbalance(${isi.data[index].stok_id},${isi.data[index].produk_id},${capital_price})' ></div>`)
                    }
                } else if (panjang == 1) {
                    $('#' + urut).append(`<input  type='hidden' id='unit${1}' value='null'> `)
                    $('#' + urut).append(`<input type='hidden' id='unit${2}' value='null'> `)
                    for (let index = 0; index < panjang; index++) {
                        $('#' + urut).append(`<div class="form-group col-sm-12"><label>${isi.data[index].maximum_unit_name}</label> <input type='number' id='unit${index+3}' value='0' style='width:100%;' onkeyup='cekbalance(${isi.data[index].stok_id},${isi.data[index].produk_id},${capital_price})'></div> `)
                    }
                }
            })
    }

    function doalert(checkboxElem, stok_id, produk_id) {
        cabang = {{session()->get('cabang')}}
        unit1 = $('#' + stok_id).find('#unit1').val();
        unit2 = $('#' + stok_id).find('#unit2').val();
        unit3 = $('#' + stok_id).find('#unit3').val();
        if (checkboxElem.checked) {
            axios.get('{{url('/api/stok/')}}/' + stok_id)
                .then(function(res) {
                    isi = res.data;
                    jumlah_system = isi.data['jumlah']
                    axios.get('{{url('/api/getunitopname/')}}/' + produk_id+'/'+cabang)
                        .then(function(res) {
                            unit3 = conversi(res);
                            if (unit3 == jumlah_system) {
                                status = '1';
                            } else {
                                status = '0';
                            }
                            axios.post('{{url('/api/stok_opname/ ')}}', {
                                'stok_id': stok_id,
                                'jumlah_fisik': unit3,
                                'balance': status,
                                'update_opname': new Date().format('y-m-d')
                            }).then(function(res) {
                                location.reload();
                            })
                        });
                })

        } else {
            alert("bye");
            console.log(stok_id);
        }
    }

    var delay = (function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    function conversi(res) {
        isi = res.data
        panjang = isi.data.length
        if (unit1 == 'null' && unit2 == 'null') {

            unit3 = (parseInt(unit3)) * isi.data[0].default_value;
        } else if (unit1 == 'null') {

            unit2 = (parseInt(unit2)) * isi.data[0].default_value;

            unit3 = (parseInt(unit2) + parseInt(unit3)) * isi.data[1].default_value;
        } else {

            unit1 = parseInt(unit1) * isi.data[0].default_value;

            unit2 = (parseInt(unit1) + parseInt(unit2)) * isi.data[1].default_value;

            unit3 = (parseInt(unit2) + parseInt(unit3)) * isi.data[2].default_value;
        }
        return unit3;
    }

    function cekbalance(stok_id, produk_id, unit_satuan_price) {
        delay(function() {
            cabang = {{session()->get('cabang')}}
            unit1 = $('#' + stok_id).find('#unit1').val();
            unit2 = $('#' + stok_id).find('#unit2').val();
            unit3 = $('#' + stok_id).find('#unit3').val();
            console.log(unit1, unit2, unit3);
            let nextd = $('td#' + stok_id).next();
            let nextd1 = nextd.next();
            nextd.html('');
            nextd1.html('');
            axios.get('{{url('/api/getunitopname/')}}/' + produk_id+'/'+cabang)
                .then(function(res) {
                    unit3 = conversi(res)
                    axios.get('{{url('/api/stok_opname/')}}/' + unit3 + '/' + stok_id)
                        .then(function(res) {
                            isi = res.data;
                            result = isi.data[0];
                            nextd.html(result.jumlah);
                            nextd1.html(result.total_harga.toFixed(2));
                        });
                });
        }, 300);



    }

    function adjustment(id_opname){
        axios.get('{{url('/api/makeadjust/')}}/' + id_opname)
        .then(function(res){
            location.reload();
        })
    }

    function print_faktur(){
        cek = window.open('{{url('/api/reportopname/')}}/', "_blank");
    }

    // $('#example2').DataTable();
    $('#example2').DataTable({
      "paging":true,
      "lengthChange":true,
      "searching":true,
      "ordering":false,
      "info":true,
      "autowidth":false,
    });
</script>