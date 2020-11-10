<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li><a><i class="fa fa-database"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('view_product')}}">Data Produk</a></li>
                    <li><a href="#">Data Stok</a></li>
                    <li><a href="{{ route('cabang') }}">Data Cabang</a></li>
                    <li><a href="{{ route('satuan') }}">Data Satuan</a></li>
                    <li><a href="{{ route('cost') }}">Data Cost</a></li>
                    <li><a href="{{ route('sales') }}">Data Sales</a></li>
                    <li><a href="#">Data Suplier</a></li>
                    <li><a href="#">Data Customer</a></li>
                    <li><a href="{{route('gudang')}}">Data Gudang</a></li>
                </ul>
            </li>

        </ul>
    </div>


</div>
