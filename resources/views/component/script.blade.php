<!-- Bootstrap -->
<script src="{{asset('/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('/assets/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('/assets/vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('/assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- jQuery Sparklines -->
<script src="{{asset('/assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- morris.js -->
<script src="{{asset('/assets/vendors/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/assets/vendors/morris.js/morris.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('/assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('/assets/vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('/assets/vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('/assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('/assets/vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('/assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('/assets/vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('/assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('/assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{asset('/assets/vendors/DateJS/build/date.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('/assets/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('/assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('/assets/build/js/custom.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('/assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('/assets/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('/assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

{{-- Datatable --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
<!-- selectpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
<!-- live serch -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
$(document).ready(function(){
    $('.select2').select2({dropdownAutoWidth: true});
})

function convertToRupiah(angka)
{
    var rupiah = '';		
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
}

function convertToAngka(rupiah)
{
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
}

// new AutoNumeric('#input', {
//     currencySymbol : 'Rp.',
//     decimalCharacter : ',',
//     digitGroupSeparator : '.',
// });
</script>