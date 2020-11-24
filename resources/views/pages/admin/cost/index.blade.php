@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Ini Halaman Cost')
<!-- Page Content -->
@section('content')
<div class="mt-2">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <button type="button" class="btn btn-round btn-success" onclick="tambahData()"><i
                            class="fa fa-plus"></i></button>
                    <table id="tabel" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cost INV</th>
                                <th>Nama Sales</th>
                                <th>Nama Other</th>
                                <th>Tanggal</th>
                                <th>Nama Cost</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fa fa-plus"></i> Operational Cost</h5>
            </div>
            <div class="modal-body">
                <input type="radio" name="radio" id="salesman" value="0"> Salesman
                <input type="radio" name="radio" id="other" value="1"> Other
                <hr>
                <div class="row" id="modal_body" style="display: none">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Cost ID</label>
                            <input type="hidden" id="id_cabang" class="form-control">
                            <input type="text" id="inv_cost" value="" readonly="" class="form-control">
                            <input type="hidden" id="inv_cost_edit" value="" readonly="" class="form-control">
                            <input type="hidden" id="cost_id" name="">
                        </div>
                        <div class="form-group" id="id_requester">
                            <label>Id Requester</label>
                            <select class="form-control" id="id_sales">
                                @foreach ($datasales as $sales): ?>
                                <option value="{{ $sales->id_sales }}">
                                    {{ "SL-".str_pad($sales->id_sales,5,"0",STR_PAD_LEFT) }} - {{ $sales->nama_sales }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <input type="date" name="" class="form-control" id="tanggal">
                        </div>
                        <div class="form-group" id="nama_other">
                            <label>Nama</label>
                            <input type="text" name="" class="form-control" id="note">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Cost Name</label>
                            <input type="text" name="" class="form-control" id="cost_nama">
                        </div>
                        <div class="form-group">
                            <label>Nominal Cost</label>
                            <input type="number" name="" class="form-control" id="nominal" onkeyup="terbilang();">
                            <br>
                            <div class="card-body bg-dark text-white text-center text-uppercase" id="terbilang">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="buttonSimpan" class="btn btn-success" onclick="simpanData()"><span
                        id="namaButton"></span></button>
                <button type="button" class="btn btn-secondary" id="close">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function terbilang(){
    var bilangan=document.getElementById("nominal").value;
    var kalimat="";
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if(panjang_bilangan > 15){
        kalimat = "Diluar Batas";
    }else{
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for(i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i),1);
        }

        var i = 1;
        var j = 0;

        /* mulai proses iterasi terhadap array angka */
        while(i <= panjang_bilangan){
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";

            /* untuk Ratusan */
            if(angka[i+2] != "0"){
                if(angka[i+2] == "1"){
                    kata1 = "Seratus";
                }else{
                    kata1 = kata[angka[i+2]] + " Ratus";
                }
            }

            /* untuk Puluhan atau Belasan */
            if(angka[i+1] != "0"){
                if(angka[i+1] == "1"){
                    if(angka[i] == "0"){
                        kata2 = "Sepuluh";
                    }else if(angka[i] == "1"){
                        kata2 = "Sebelas";
                    }else{
                        kata2 = kata[angka[i]] + " Belas";
                    }
                }else{
                    kata2 = kata[angka[i+1]] + " Puluh";
                }
            }

            /* untuk Satuan */
            if (angka[i] != "0"){
                if (angka[i+1] != "1"){
                    kata3 = kata[angka[i]];
                }
            }

            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
            }

            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }

        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")){
            kalimat = kalimat.replace("Satu Ribu","Seribu");
        }
    }
    document.getElementById("terbilang").innerHTML=kalimat +"Rupiah";
}
</script>

<script>
    $(document).ready(function(){
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/cost/datatable') }}",
        },
        columns:[
        {
            data: null,
            render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
          {
            data: 'inv_cost'
          },
          {
            data: 'nama_sales'
          },
          {
            data: 'note'
          },
          {
            data: 'tanggal'
          },
          {
            data: 'cost_nama'
          },
          {
            data: 'nominal'
          },
          {
            data: null,
            render: function(data, type, row, meta) {
            return "<div>" +
                "<button type='button' onclick='deleted(" + data.cost_id + ")' class='btn btn-danger'>Hapus</button> | " +
                "<button type='button' onclick='ambilData(" + data.cost_id + ")' class='btn btn-success'>Edit</button>" +
            "</div>" ;
            }
          }
        ]
      });
    });

   function tambahData()
   {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#tanggal').val(today)
    $('#salesman').prop('checked', false)
    $('#other').prop('checked', false)
    $('#buttonSimpan').css('display', 'block');
    $('#buttonEdit').css('display', 'none');
    $('#modalCost').modal('show')
    $('#cost_id').val('');
    $('#inv_cost').attr('type', 'text');
    $('#inv_cost_edit').attr('type', 'hidden');
    $('#namaButton').text('Simpan Data')
   }

   function simpanData()
   {
    var radio_salesman = $('#salesman:checked').val();
    var inv_cost = $('#inv_cost').val();
    var tanggal = $('#tanggal').val();
    var id_sales = $('#id_sales').val();
    var cost_nama = $('#cost_nama').val();
    var nominal = $('#nominal').val();
    var note = $('#note').val();
    var salesman = $('#salesman').val()
    var other = $('#other').val()
    var cost_id = $('#cost_id').val()
    var id_cabang = $('#id_cabang').val()
    if(radio_salesman){
        var data_cost = {
            cost_id: parseInt(cost_id),
            inv_cost:inv_cost,
            tanggal: tanggal,
            cost_nama: cost_nama,
            nominal: nominal,
            type:salesman,
            id_cabang:id_cabang,
            id_sales:id_sales
        }
    }else{
        var data_cost = {
            cost_id: parseInt(cost_id),
            inv_cost:inv_cost,
            tanggal: tanggal,
            cost_nama: cost_nama,
            nominal: nominal,
            type:other,
            id_cabang:id_cabang,
            note:note
        }
    }
    if(cost_id.toString().length == 0)
    {
        axios.post('{{url('/api/cost/')}}', data_cost)
        .then(function (res) {
            var data = res.data
            console.log(data.status)
            if(data.status == 200)
            {
                tables.ajax.reload()
                toastr.info(data.message)
                bersih()
                var pecah = inv_cost
                var c = pecah.slice(0,-1);
                var a = pecah.slice(-1);
                var b = parseInt(a) + 1;
                var d = c + b;
                $('#salesman').prop('checked', false)
                $('#other').prop('checked', false)
                $('#inv_cost').val(d);
                $('#modal_body').css('display', 'none');
                $('#modalCost').modal('hide')
            }
        })
    }
    else
    {
        axios.put('{{url('/api/cost/')}}', data_cost)
        .then(function (res) {
            var data = res.data
            console.log(data.status)
            if(data.status == 200)
            {
                tables.ajax.reload()
                toastr.info(data.message)
                bersih()
                // $('#inv_cost').val('{{ $invoice }}');
                $('#salesman').prop('checked', false)
                $('#other').prop('checked', false)
                $('#modal_body').css('display', 'none');
                $('#modalCost').modal('hide')
            }
        })
    }
   }

   function deleted(id)
    {
        axios.delete('{{url('/api/cost/remove')}}/'+id)
            .then(function(res){
            var data = res.data
            tables.ajax.reload()
            toastr.info(data.message)
        })
    }

    function bersih()
    {
        $('#cost_nama').val('')
        $('#nominal').val('')
        document.getElementById('id_sales').selectedIndex = 0;
        $('#nominal').val('')
        $('#note').val('')
        $('#terbilang').empty()
    }

    $('#other').click(function(){
        var other = document.getElementById('other').checked
        console.log(other)
        if (other == true) {
            $('#nama_other').show()
            $('#modal_body').show()
            $('#id_requester').css('display', 'none')
        }else{
            $('#nama_other').css('display', 'none')
            $('#modal_body').hide()
            $('#id_requester').css('display', 'none')
        }
    })

    function ambilData(id)
    {
        axios.get('{{url('/api/cost')}}/'+ id)
        .then(function(res) {
            var isi = res.data
            pemilihan = isi.data.type
            console.log(isi.data.type)
            if(pemilihan == 0)
            {
                $('#salesman').prop('checked', true)
                $('#id_requester').show()
                $('#modal_body').show()
                $('#nama_other').css('display', 'none')
                document.getElementById('cost_id').value=isi.data.cost_id;
                document.getElementById('inv_cost_edit').value=isi.data.inv_cost;
                document.getElementById('id_sales').value=isi.data.id_sales;
                document.getElementById('tanggal').value=isi.data.tanggal;
                document.getElementById('cost_nama').value=isi.data.cost_nama;
                document.getElementById('nominal').value=isi.data.nominal;
                document.getElementById('id_cabang').value=isi.data.id_cabang;
                $('#inv_cost').attr('type', 'hidden');
                $('#inv_cost_edit').attr('type', 'text');
            }
            else
            {
                $('#other').prop('checked', true)
                $('#nama_other').show()
                $('#modal_body').show()
                $('#id_requester').css('display', 'none')
                document.getElementById('cost_id').value=isi.data.cost_id;
                document.getElementById('inv_cost_edit').value=isi.data.inv_cost;
                document.getElementById('note').value=isi.data.note;
                document.getElementById('tanggal').value=isi.data.tanggal;
                document.getElementById('cost_nama').value=isi.data.cost_nama;
                document.getElementById('nominal').value=isi.data.nominal;
                $('#inv_cost').attr('type', 'hidden');
                $('#inv_cost_edit').attr('type', 'text');
            }
            $('#namaButton').text('Edit Data')
            $('#modalCost').modal('show')
        })
    }

    $('#salesman').click(function(){
        var salesman = document.getElementById('salesman').checked
        console.log(salesman)
        if (salesman == true) {
            $('#id_requester').show()
            $('#modal_body').show()
            $('#nama_other').css('display', 'none')
        }else{
            $('#id_requester').css('display', 'none')
            $('#modal_body').hide()
            $('#nama_other').css('display', 'none')
        }
    })

    $('#close').click(function(){
        $('input[name ="radio"]').prop('checked', false);
        bersih()
        $('#modalCost').modal('hide')
        $('#modal_body').hide()
    })

    $('#inv_cost').val('{{ $invoice }}');
    $('#id_cabang').val('{{ $id_cabang }}');

</script>
@endsection
