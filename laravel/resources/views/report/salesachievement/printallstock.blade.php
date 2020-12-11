<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Achievment</title>
    <link href="{{asset('/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <h4>REPORT OF STOCK SALES RECAPITULATION</h4>
                    <h5>CV. GEMILANG MITRA SUKSES</h5>
                    <h6>GADUIK</h6>
                    <h6>AGAM</h6>
                    <H6>HP : 081363354666 / PHONE:(0752) 8810863</H6>
                    <br>
                </div>
            </div>
        </div>
        <hr style="border: 2px solid black">
        <div class="row">
            <div class="col-sm-4">
                <b>Report Type :</b>
            </div>
            <div class="col-sm-5 offset-3">
                <b>Salesman: ANDRE ALFINDRA(ALL TRANSACTION)</b>
            </div>
        </div>
        <table border="2" id="tabel" style="border: 2px solid black; width:100%;">
            <thead>
                <tr>
                    <th>PRODUCT ID</th>
                    <th>PRODUCT DESCRIPTION</th>
                    <th>QUANTITY</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Test</td>
                    <td>Test</td>
                    <td>Test</td>
                </tr>
            </tbody>
        </table>

    </div>


    <!-- script -->
    <script src="{{asset('/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            window.print();
    });
    </script>
</body>

</html>
