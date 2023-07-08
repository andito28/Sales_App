@php
    use App\Models\Order;
    $count = Order::where('status', 'pending')->count();
@endphp
<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between mb-0 pb-0">
        <h3><a href="/">DRCC</a></h3>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a href="/">
                <div class="icon_menu">
                    <img src="{{ asset('pages/img/menu-icon/dashboard.svg') }}" alt="">
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('dashboard.sales') }}">
                <div class="icon_menu">
                    <img src="{{ asset('pages/img/menu-icon/4.svg') }}" alt="">
                </div>
                <span>Sales</span>
            </a>
        </li>
        <li class="">
            <a href="{{ route('dashboard.transaksi') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('pages/') }}/img/menu-icon/5.svg" alt="">
                </div>
                <span>Transaksi
                    <span class="badge rounded-pill bg-danger">
                        {{ $count }}
                    </span>
                </span>
            </a>
        </li>
    </ul>
</nav>
