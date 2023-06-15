<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center pb-2 pt-2">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center" style="margin-left: 97%">
                    <div class="profile_info">
                        <img src="{{ asset('pages') }}/img/client_img.png" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <p>{{ Auth::user()->name }} </p>
                            </div>
                            <div class="profile_info_details">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" href="#" type="submit">
                                        <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
