<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('dashboard') }}"><i class
                        ="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Produk</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li>
                            <a href="{{ route('products.index') }}"> <i class="fa fa-shopping-bag"></i>Lihat Produk</a>
                        </li>
                        <li class="">
                            <a href="{{ route('product-galleries.index') }}"> <i class="fa fa-image"></i>Foto Produk</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{ route('transactions.index') }}"><i class="menu-icon fa fa-tag"></i>Transaksi</a>
                </li>
                @can('S_Administrator')
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Pengaturan Aplikasi</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li class="">
                            <a href="{{ route('app.edit',1) }}"> <i class=" fa fa-cog"></i>Informasi Aplikasi</a>
                        </li>
                        <li class="">
                            <a href="{{ route('hero-apps.index') }}"> <i class=" fa fa-desktop"></i>Landing Page</a>
                        </li>
                        <li class="">
                            <a href="{{ route('users.index') }}"> <i class=" fa fa-users"></i>User</a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
