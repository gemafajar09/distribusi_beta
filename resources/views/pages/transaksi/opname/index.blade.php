@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Stock Opname And Adjusment')
<!-- Page Content -->
@section('content')

<div class="row">
<div class="col-sm-12">
    <div class="card-box table-responsive">
        <div id="isibody">

        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function(){     
        $('#isibody').load('{{ route('datatablesopname')}}');
    });

    function deleted(id)
    {
        
        axios.delete('{{url('/api/unit/')}}/'+id)
            .then(function(res){
            var data = res.data
            tables.ajax.reload()
            toastr.info(data.message)
        })
    }

    $('#add').click(function(e){
        e.preventDefault();
        let produk_id = $('#produk_id').val();
        let unit1 = $('#unit1').val();
        let unit2 = $('#unit2').val();
        let unit3 = $('#unit3').val();
        
        axios.get('{{url('/api/getunit/')}}/'+produk_id)
                    .then(function(res){
                        isi = res.data
                        panjang = isi.data.length
                        if(unit1 == 'null' && unit2 == 'null'){
                            unit3 = (parseInt(unit3))* isi.data[0].default_value;
                        }else if(unit1 == 'null') {
                            unit2 = (parseInt(unit2)) * isi.data[0].default_value;
                            unit3 = (parseInt(unit2)+parseInt(unit3))* isi.data[1].default_value; 
                        }else{
                            unit1 = parseInt(unit1) * isi.data[0].default_value;
                            unit2 = (parseInt(unit1)+parseInt(unit2)) * isi.data[1].default_value;
                            unit3 = (parseInt(unit2)+parseInt(unit3))* isi.data[2].default_value; 
                        }
                        console.log(unit3)
                    });
        
    })

    // function bersih()
    // {
    //     $("#maximum_unit_name").val([]).selectpicker('refresh');
    //     $("#minimum_unit_name").val([]).selectpicker('refresh');
    //     $("#produk_id").val([]).selectpicker('refresh');
    //     document.getElementById("default_value").value=null;
    //     document.getElementById("note").value=null;
        
    // }
</script>
@endsection
