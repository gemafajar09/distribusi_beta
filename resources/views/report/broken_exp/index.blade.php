@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Broken And Exp Report')
<!-- Page Content -->
@section('content')
<div class="mt-2">
    <div class="x_content">
        <div class="row bg-white p-3 rounded mb-3" style="box-shadow:1px 1px 4px grey;">
            <div class="text-center">
                <button type="button" class="btn btn-outline-success" id="refresh"><i class="fa fa-print"></i>
                    Refresh
                    Report</button>
                <button type="button" class="btn btn-outline-info" id="generate"><i class="fa fa-print"></i>
                    Generate
                    Report</button>
                <div class="form-group">
                    <label for="">Filter By :</label>
                    <select name="" id="pilihan" class="form-control" onchange="pilihan()">
                        <option value="allstock">ALL STOCK</option>
                        <option value="product">PRODUCT DESCRIPTION</option>
                    </select>
                </div>
                <input type="text" class="form-control" id="inputpilihan" style="display: none">
            </div>

            <div class="col-sm-12" id="tabelbrokenexp">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#tabelbrokenexp').load('{{ route('tablereport')}}')
    })

    function pilihan()
    {
        var select = document.getElementById('pilihan').value;
        if(select == "allstock")
        {
            $('#inputpilihan').hide()
            $('#tabelbrokenexp').load('{{ route('tablereport')}}')
        }
        else
        {
            $('#inputpilihan').show()
            $('#inputpilihan').keyup(function ()
            {
                    $('#tabelbrokenexp').load('{{ route('tablereport')}}/' + $('#inputpilihan').val())
            });
        }
    }

    $('#generate').click(function () {
        var pilihandata = document.getElementById('pilihan').value;
        var search = document.getElementById('inputpilihan').value;
        if(pilihandata == "allstock")
        {
            window.open(`{{route('printbroken')}}`);
        }
        else
        {
            window.open(`{{url('/broken/printproduct')}}/`+ search);
        }
    });

    $('#refresh').click(function () {
        window.location.reload()
    });

</script>
@endsection
