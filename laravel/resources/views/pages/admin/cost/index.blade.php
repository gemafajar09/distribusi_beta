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
                <div class="card">
                    <div class="card-body">
                        <input type="radio" name="radio" id="salesman" value="0"> Salesman
                        <input type="radio" name="radio" id="other" value="1"> Other
                        <hr>
                        <div id="body" style="display: none">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cost ID</label>
                                    <input type="hidden" id="id_cabang" class="form-control">
                                    <input type="text" id="inv_cost" value="" readonly="" class="form-control">
                                    {{-- <input type="hidden" id="inv_cost_edit" value="" readonly="" class="form-control">
                                    <input type="hidden" id="cost_id" name=""> --}}
                                </div>
                                <div class="form-group" id="id_requester">
                                    <label>Id Requester</label>
                                    <select class="form-control" id="id_sales">
                                        @foreach ($datasales as $sales): ?>
                                        <option value="{{ $sales->id_sales }}">
                                            {{ $sales->id_sales }} - {{ $sales->nama_sales }}
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
                                <button type="button" id="buttonSimpan" class="btn btn-outline-success"
                                    onclick="simpanData()"><i class="fa fa-plus"></i>
                                    {{-- <span id="namaButton"></span> --}}
                                </button>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cost Name</label>
                                    <input type="text" name="" class="form-control" id="cost_nama">
                                </div>
                                <div class="form-group">
                                    <label>Nominal Cost</label>
                                    <input type="number" name="" class="form-control" id="nominal"
                                        onkeyup="terbilang();">
                                    <br>
                                    <div class="card-body bg-dark text-white text-center text-uppercase"
                                        id="terbilang_">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card-box table-responsive">
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
            <div class="modal-body" id="modal_body">
                <input type="radio" name="radio" id="salesman_edit" value="0"> Salesman
                <input type="radio" name="radio" id="other_edit" value="1"> Other
                <hr>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cost ID</label>
                        <input type="hidden" id="id_cabang_edit" class="form-control">
                        <input type="text" id="inv_cost_edit" value="" readonly="" class="form-control">
                        {{-- <input type="hidden" id="inv_cost_edit" value="" readonly="" class="form-control"> --}}
                        <input type="hidden" id="cost_id_edit" name="">
                    </div>
                    <div class="form-group" id="id_requester_edit">
                        <label>Id Requester</label>
                        <select class="form-control" id="id_sales_edit">
                            @foreach ($datasales as $sales): ?>
                            <option value="{{ $sales->id_sales }}">
                                {{ $sales->id_sales }} - {{ $sales->nama_sales }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input type="date" name="" class="form-control" id="tanggal_edit">
                    </div>
                    <div class="form-group" id="nama_other_edit">
                        <label>Nama</label>
                        <input type="text" name="" class="form-control" id="note_edit">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cost Name</label>
                        <input type="text" name="" class="form-control" id="cost_nama_edit">
                    </div>
                    <div class="form-group">
                        <label>Nominal Cost</label>
                        <input type="number" name="" class="form-control" id="nominal_edit" onkeyup="terbilang();">
                        <br>
                        <div class="card-body bg-dark text-white text-center text-uppercase" id="terbilang">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="buttonEdit" class="btn btn-success" onclick="editData()"> Edit
                    Data
                    {{-- <span id="namaButton"></span> --}}
                </button>
                <button type="button" class="btn btn-secondary" id="close">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function terbilang(){
    var bilangan=document.getElementById("nominal").value;
    var bilangan=document.getElementById("nominal_edit").value;
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
    document.getElementById("terbilang_").innerHTML=kalimat +"Rupiah";
}
</script>

<script>
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

    $(document).ready(function(){
      id_cabang = {{session()->get('cabang')}}
      tables = $('#tabel').DataTable({
        processing : true,
        serverSide : true,
        ajax:{
          url: "{{ url('/api/cost/datatable') }}/"+id_cabang,
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

//    function tambahData()
//    {
//     var now = new Date();
//     var day = ("0" + now.getDate()).slice(-2);
//     var month = ("0" + (now.getMonth() + 1)).slice(-2);
//     var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
//     $('#tanggal').val(today)
//     $('#salesman').prop('checked', false)
//     $('#other').prop('checked', false)
    // $('#buttonSimpan').css('display', 'block');
    // $('#buttonEdit').css('display', 'none');
    // $('#modalCost').modal('show')
    // $('#cost_id').val('');
    // $('#inv_cost').attr('type', 'text');
    // $('#inv_cost_edit').attr('type', 'hidden');
    // $('#namaButton').text('Simpan Data')
//    }

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
            inv_cost:inv_cost,
            tanggal: tanggal,
            cost_nama: cost_nama,
            nominal: nominal,
            type:other,
            id_cabang:id_cabang,
            note:note
        }
    }
    // if(cost_id.toString().length == 0)
    // {
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
                $('#body').css('display', 'none');
                $('#modalCost').modal('hide')
            }
        })
    // }
    // else
    // {
    //     axios.put('{{url('/api/cost/')}}', data_cost)
    //     .then(function (res) {
    //         var data = res.data
    //         console.log(data.status)
    //         if(data.status == 200)
    //         {
    //             tables.ajax.reload()
    //             toastr.info(data.message)
    //             bersih()
    //             $('#inv_cost').val('{{ $invoice }}');
    //             $('#salesman').prop('checked', false)
    //             $('#other').prop('checked', false)
    //             $('#body').css('display', 'none');
    //             $('#modalCost').modal('hide')
    //         }
    //     })
    // }
   }

   function editData()
   {
    var radio_salesman_edit = $('#salesman_edit:checked').val();
    var inv_cost_edit = $('#inv_cost_edit').val();
    var tanggal_edit = $('#tanggal_edit').val();
    var id_sales_edit = $('#id_sales_edit').val();
    var cost_nama_edit = $('#cost_nama_edit').val();
    var nominal_edit = $('#nominal_edit').val();
    var note_edit = $('#note_edit').val();
    var salesman_edit = $('#salesman_edit').val()
    var other_edit = $('#other_edit').val()
    var cost_id_edit = $('#cost_id_edit').val()
    var id_cabang_edit = $('#id_cabang_edit').val()
    if(radio_salesman_edit){
        var data_cost_edit = {
            cost_id:cost_id_edit,
            inv_cost:inv_cost_edit,
            tanggal: tanggal_edit,
            cost_nama: cost_nama_edit,
            nominal: nominal_edit,
            type:salesman_edit,
            id_cabang:id_cabang_edit,
            id_sales:id_sales_edit
        }
    }else{
        var data_cost_edit = {
            cost_id:cost_id_edit,
            inv_cost:inv_cost_edit,
            tanggal: tanggal_edit,
            cost_nama: cost_nama_edit,
            nominal: nominal_edit,
            type:other_edit,
            id_cabang:id_cabang_edit,
            note:note_edit
        }
    }
    axios.put('{{url('/api/cost/')}}', data_cost_edit)
        .then(function (res) {
            var data = res.data
            console.log(data.status)
            if(data.status == 200)
            {
                tables.ajax.reload()
                toastr.info(data.message)
                $('#modalCost').modal('hide')
            }
        })
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

    function ambilData(id)
    {
        axios.get('{{url('/api/cost')}}/'+ id)
        .then(function(res) {
            var isi = res.data
            pemilihan = isi.data.type
            console.log(isi.data)
            if(pemilihan == 0)
            {
                $('#salesman_edit').prop('checked', true)
                $('#id_requester_edit').show()
                $('#modal_body').show()
                $('#nama_other_edit').css('display', 'none')
                document.getElementById('cost_id_edit').value=isi.data.cost_id;
                document.getElementById('inv_cost_edit').value=isi.data.inv_cost;
                document.getElementById('id_sales_edit').value=isi.data.id_sales;
                document.getElementById('tanggal_edit').value=isi.data.tanggal;
                document.getElementById('cost_nama_edit').value=isi.data.cost_nama;
                document.getElementById('nominal_edit').value=isi.data.nominal;
                document.getElementById('id_cabang_edit').value=isi.data.id_cabang;
                // $('#inv_cost').attr('type', 'hidden');
                // $('#inv_cost_edit').attr('type', 'text');
            }
            else
            {
                $('#other_edit').prop('checked', true)
                $('#nama_other_edit').show()
                $('#modal_body').show()
                $('#id_requester_edit').css('display', 'none')
                document.getElementById('cost_id_edit').value=isi.data.cost_id;
                document.getElementById('inv_cost_edit').value=isi.data.inv_cost;
                document.getElementById('note_edit').value=isi.data.note;
                document.getElementById('tanggal_edit').value=isi.data.tanggal;
                document.getElementById('cost_nama_edit').value=isi.data.cost_nama;
                document.getElementById('nominal_edit').value=isi.data.nominal;
                document.getElementById('id_cabang_edit').value=isi.data.id_cabang;
                // $('#inv_cost').attr('type', 'hidden');
                // $('#inv_cost_edit').attr('type', 'text');
            }
            // $('#namaButton').text('Edit Data')
            $('#modalCost').modal('show')
        })
    }

    $('#other').click(function(){
        $('#tanggal_edit').val(today)
        var other = document.getElementById('other').checked
        console.log(other)
        if (other == true) {
            $('#nama_other').show()
            $('#body').show()
            $('#id_requester').css('display', 'none')
        }else{
            $('#nama_other').css('display', 'none')
            $('#body').hide()
            $('#id_requester').css('display', 'none')
        }
    })

    $('#salesman').click(function(){
        $('#tanggal').val(today)
        var salesman = document.getElementById('salesman').checked
        console.log(salesman)
        if (salesman == true) {
            $('#id_requester').show()
            $('#body').show()
            $('#nama_other').css('display', 'none')
        }else{
            $('#id_requester').css('display', 'none')
            $('#body').hide()
            $('#nama_other').css('display', 'none')
        }
    })

    // edit
    $('#other_edit').click(function(){
        $('#tanggal_edit').val(today)
        var other = document.getElementById('other_edit').checked
        console.log(other)
        if (other == true) {
            $('#nama_other_edit').show()
            $('#modal_body').show()
            $('#id_requester_edit').css('display', 'none')
        }else{
            $('#nama_other_edit').css('display', 'none')
            $('#modal_body').hide()
            $('#id_requester_edit').css('display', 'none')
        }
    })

    $('#salesman_edit').click(function(){
        $('#tanggal_edit').val(today)
        var salesman = document.getElementById('salesman_edit').checked
        console.log(salesman)
        if (salesman == true) {
            $('#id_requester_edit').show()
            $('#modal_body').show()
            $('#nama_other_edit').css('display', 'none')
        }else{
            $('#id_requester_edit').css('display', 'none')
            $('#modal_body').hide()
            $('#nama_other_edit').css('display', 'none')
        }
    })

    $('#close').click(function(){
        $('input[name ="radio"]').prop('checked', false);
        bersih()
        $('#modalCost').modal('hide')
        $('#body').hide()
    })

    $('#inv_cost').val('{{ $invoice }}');
    $('#id_cabang').val('{{ $id_cabang }}');

</script>
@endsection
