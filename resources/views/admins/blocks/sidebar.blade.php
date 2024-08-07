      <!-- Left Sidebar Start -->
      <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <a class='logo logo-light' href='{{ url('index.html') }}'>
                        <span class="logo-sm">
                            <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admin/assets/images/logo-light.png') }}" alt=""
                                height="24">
                        </span>
                    </a>
                    <a class='logo logo-dark' href='{{ url('index.html') }}'>
                        <span class="logo-sm">
                            <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt=""
                                height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/admin/assets/images/logo-dark.png') }}" alt=""
                                height="24">
                        </span>
                    </a>
                </div>

                <ul id="side-menu">
                    <li class="menu-title">Quản Trị</li>
                    <li>
                        <a class='tp-link' href=''>
                            <i data-feather="home"></i>
                            <span> Quản lý danh mục </span>
                        </a>
                    </li>

                    <li>
                        <a class='tp-link' href='{{ url('calendar.html') }}'>
                            <i data-feather="users"></i>
                            <span> Quản lý tài khoản </span>
                        </a>
                    </li>
                   
                </ul>

                <ul id="side-menu">
                    <li class="menu-title">Kinh Doanh</li>
                    <li>
                        <a class='tp-link' href='{{ route('admins.category.index')}}'>
                            <i data-feather="box"></i>
                            <span> Danh Sách Mục </span>
                        </a>
                    </li>

                    <li>
                        <a class='tp-link' href='{{ route('admins.products.index')}}'>
                            <i data-feather="package"></i>
                            <span> Sản Phẩm </span>
                        </a>
                    </li>

                    
                    <li>
                        <a class='tp-link' href='{{ route('admins.qlydonhangs.index')}}'>
                            <i data-feather="shopping-bag"></i>
                            <span> Quản lý sản phẩm </span>
                        </a>
                    </li>

                     
                    <li>
                        <a class='tp-link' href='{{ route('admins.statistics.index')}}'>
                            <i data-feather="shopping-bag"></i>
                            <span> Thống kê sản phẩm </span>
                        </a>
                    </li>

                       
                    <li>
                        <a class='tp-link' href='{{ route('admins.promotions.index')}}'>
                            <i data-feather="shopping-bag"></i>
                            <span>Quản lý khuyến mãi </span>
                        </a>
                    </li>
                   
                    <li>
                        <a class='tp-link' href='{{ route('admins.comments.index')}}'>
                            <i data-feather="shopping-bag"></i>
                            <span>Quản lý Bình Luận </span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- Left Sidebar End -->
