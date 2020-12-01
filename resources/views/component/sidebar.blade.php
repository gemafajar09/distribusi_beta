<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">

            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li><a><i class="fa fa-database"></i> Data Master <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('produk')}}">Data Produk</a></li>
                    <li><a href="{{route('stok')}}">Data Stok</a></li>

                    <li><a href="{{ route('satuan') }}">Data Satuan</a></li>
                    <li><a href="{{ route('sales') }}">Data Sales</a></li>
                    <li><a href="{{ route('suplier') }}">Data Suplier</a></li>
                    <li><a href="{{route('customer')}}">Data Customer</a></li>
                    <li><a href="{{route('gudang')}}">Data Gudang</a></li>
                    <li><a href="{{route('spesial')}}">Data Harga Kshusus</a></li>
                    <li><a href="{{route('type')}}">Data Type Produk</a></li>
                    <li><a href="{{route('unit')}}">Data Unit</a></li>

                </ul>
            </li>
            <li><a><i class="fa fa-calculator"></i> Transaction <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a><i class=""></i>Sales Transaction <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('sales_transaction') }}">Report Transaction</a></li>
                            <li><a href="{{ route('sales_transaction') }}">Entry Transaction</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('cost') }}">Data Cost</a></li>
                    <li><a><i class=""></i>Purchase Transaction <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('purchase_order') }}">Report Transaction</a></li>
                            <li><a href="{{ route('purchase_order') }}">Entry Transaction</a></li>
                            <li><a href="{{ route('return_purchase_order') }}">Return Transaction</a></li>

                        </ul>
                    </li>
                    <li><a href="{{ route('opname') }}">Data Opname</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-file"></i> Report <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('cost') }}">Data Cost</a></li>
                    <li><a href="{{ route('sales_transaction') }}">Sales Transaction</a></li>
                    <li><a href="{{ route('stok-report') }}">Stok Inventory</a></li>
                    <li><a href="{{ route('purchase-report') }}">Purchase</a></li>
                </ul>
            </li>

        </ul>
    </div>


</div>
