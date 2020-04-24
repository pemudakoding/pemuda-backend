<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard') }}"><i class
                        ="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">Modul Produk</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('products.index') }}"> <i class="menu-icon fa fa-list"></i>Produk</a>
                    <a href="{{ route('product-galleries.index') }}"> <i class="menu-icon fa fa-list"></i>Foto Produk</a>
                </li>

                <li class="menu-title">Transaksi</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('transactions.index') }}"> <i class="menu-icon fa fa-list"></i>Transaksi</a>
                </li>
                <li class="menu-title">Modul Aplikasi</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('app.edit',1) }}"> <i class="menu-icon fa fa-list"></i>Pengaturan</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->