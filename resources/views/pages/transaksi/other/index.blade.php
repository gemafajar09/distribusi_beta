@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Manajamen profile')
<!-- Page Content -->
@section('content')
<div class="mt-2">
    <div class="x_content">
        <div class="row bg-white p-3 rounded mb-3" style="box-shadow:1px 1px 4px grey;">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">ID USER</label>
                    <input type="text" id="id_user" class="form-control" readonly value="{{$data->id_user}}">
                </div>
                <div class="form-group">
                    <label for="">NAMA USER</label>
                    <input type="text" id="nama_user" class="form-control" value="{{$data->nama_user}}" required>
                </div>
                <div class="form-group">
                    <label for="">USERNAME</label>
                    <input type="text" id="username" class="form-control" value="{{$data->username}}" readonly>
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" id="password_user" class="form-control" placeholder="New Password" required>
                </div>
                <div class="form-group">
                    <label for="">VALIDATE PASSWORD</label>
                    <input type="password" id="password_user_ulang" class="form-control" placeholder="Ulangi Password" required>
                </div>
                <div class="form-group">
                    <label for="">LEVEL</label>
                    <select name="" id="" disabled='true' class="form-control">
                        <option>{{$data->nama_role}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">TELEPON</label>
                    <input type="number" id="telepon" class="form-control" value="{{$data->telepon}}" required>
                </div>
                <div class="form-group">
                    <label for="">EMAIL</label>
                    <input type="email" id="email" class="form-control" value="{{$data->email}}" required>
                </div>
                <div class="form-group">
                    <label for="">CABANG</label>
                    <select name="" id="" disabled='true' class="form-control">
                        <option value="">{{$data->nama_cabang}}</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-md-2">
                        <button type="button" style="width:140px;" id="save" class="btn btn-outline-success btn-sm">Save</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" style="width:140px;" id="edit" class="btn btn-outline-warning btn-sm">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function(){
        $("#nama_user").prop('disabled', true);
        $("#password_user").prop('disabled', true);
        $("#password_user_ulang").prop('disabled', true);
        $("#telepon").prop('disabled', true);
        $("#email").prop('disabled', true);
        $("#save").prop('disabled', true);

        $('#edit').click(function(){
            $("#nama_user").prop('disabled', false);
            $("#password_user").prop('disabled', false);
            $("#password_user_ulang").prop('disabled', false);
            $("#telepon").prop('disabled', false);
            $("#email").prop('disabled', false);
            $("#save").prop('disabled', false);
        });

        $('#save').click(function(){
            id_user = $("#id_user").val();
            nama_user = $("#nama_user").val();
            password_user = $("#password_user").val();
            password_user_ulang = $("#password_user_ulang").val();
            telepon = $("#telepon").val();
            email = $("#email").val();
            console.log(password_user);
            if(!password_user){
                alert("Password Tidak Boleh Kosong")
            }else{
            if(password_user == password_user_ulang){
            axios.put('{{url('/api/profile/')}}',{
                id_user:id_user,
                nama_user:nama_user,
                password:password_user,
                telepon:telepon,
                email:email,
            }).then(function(res){
                var data = res.data
                toastr.info(data.message)
                $("#nama_user").prop('disabled', true);
                $("#password_user").prop('disabled', true);
                $("#password_user_ulang").prop('disabled', true);
                $("#telepon").prop('disabled', true);
                $("#email").prop('disabled', true);
                $("#save").prop('disabled', true);
            })
        }else{
            alert("Password Harus Sama");
        }
    }
        })
        
    });
</script>
@endsection
