<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                <img src="{{ asset('images/icon-library.png') }}" style="width:13%;margin-left:25px;"
                    alt="">&nbsp;
                <span class="text-xl pl-2">{{ config('app.name', 'Laravel') }}</span>
        </div>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="dashboard">
                <i class="cil-home"></i>&nbsp; Dashboard
            </a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="c-sidebar-nav-title">MASTER</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users.index')}}">
                <i class="cil-people"></i>&nbsp; Users
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('pengarang.index')}}">
                <i class="cil-user"></i>&nbsp; Pengarang
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('penerbit.index')}}">
                <i class="cil-pen"></i>&nbsp; Penerbit
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('buku.index')}}">
                <i class="cil-book"></i>&nbsp; Buku
            </a>
        </li>
        @endif
        @if (Auth::user()->role == 'user' || Auth::user()->role == 'admin' )
        <li class="c-sidebar-nav-title">TRANSAKSI</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('peminjaman-buku.index')}}">
                <i class="cil-money"></i>&nbsp; Peminjaman Buku
            </a>
        </li>
        @endif
    </ul>
</div>
