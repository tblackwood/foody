<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('backend/img/sidebar-1.jpg') }}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
            <img src="{{ asset('images/icons/logo.png') }}" alt="IMG-LOGO" data-logofixed="{{ asset('images/icons/logo2.png') }}">
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item @if(Request::is('admin/dashboard')){{ 'active' }} @endif  ">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item @if(Request::is('admin/slider*')){{ 'active' }} @endif">
                <a class="nav-link" href="{{ route('slider.index') }}">
                    <i class="material-icons">slideshow</i>
                    <p>Sliders</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/menu-category*') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('menu-category.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/menu-items*') ? 'active': '' }}">
                <a class="nav-link" href=" {{ route('menu-items.index') }}">
                    <i class="material-icons">restaurant_menu</i>
                    <p>Menu</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/reservation*') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('admin-reservation.index') }}">
                    <i class="material-icons">room_service</i>
                    <p>Reservations</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/contact*') ? 'active': '' }}">
                <a class="nav-link" href="{{ route('admin-contact.index') }}">
                    <i class="material-icons">message</i>
                    <p>Contact Message</p>
                </a>
            </li>

        </ul>
    </div>
</div>
