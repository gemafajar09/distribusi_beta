<?php 
$no = 0; 
?>
@foreach($isi as $a)
<?php
$no++;
$data = explode(" ",$a);
?>
<div class="col-md-4">
    <div class="input-group">
        <input readonly type="text" value="{{$data[0]}}" class="form-control" id="stok<?= $no ?>">
        <input readonly type="hidden" value="{{$data[2]}}" class="form-control" id="pecah<?= $no ?>">
        <div class="input-group-prepend">
            <div class="input-group-text">{{$data[1]}}</div>
        </div>
    </div>
    <div class="input-group">
        <input type="text" value="0" class="form-control" id="jumlah<?= $no ?>">
        <div class="input-group-prepend">
            <div class="input-group-text">{{$data[1]}}</div>
        </div>
    </div>
</div>
@endforeach
<input type="hidden" id="totals" value="<?= $no?>">