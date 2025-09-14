<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo" style="width: 40px;height:40px;.">
                <img src="{{ asset('assets/logo/logo-project.png') }}" alt="Logo" class="w-100 h-100">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">FurrShield</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('dashboard.show') ? 'active' : '' }}">
            <a href="{{ route('dashboard.show') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        {{-- Info: Admin --}}
        @can('admin-view')
            {{-- ! Vaccines --}}
            <li class="menu-item  {{ Route::is('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-group"></i>
                    <div data-i18n=" Manage Users"> Manage Users</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('vets.*') ? 'active' : '' }}">
                <a href="{{ route('vets.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-user-voice"></i>
                    <div data-i18n=" Veterinarians"> Veterinarians</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('shelter.*') ? 'active' : '' }}">
                <a href="{{ route('shelter.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-home-heart"></i>
                    <div data-i18n=" Animal Shelters"> Animal Shelters</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('appts.*') ? 'active' : '' }}">
                <a href="{{ route('appts.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-calendar-check"></i>
                    <div data-i18n=" Appointments"> Appointments</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('orders.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-cart-alt"></i>
                    <div data-i18n=" Orders"> Orders</div>
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ route('products.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-package"></i>
                    <div data-i18n=" Products"> Products</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('dashboard/articles*') ? 'active' : '' }}">
                <a href="{{ route('admin.articles.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-news"></i>
                    <div data-i18n=" Manage Content"> Manage Articles</div>
                </a>
            </li>
        @endcan
        {{-- Info: Admin End --}}

        @can('shelter-view')
            {{-- Adoption Listings --}}
            <li class="menu-item {{ Route::is('adoption.*') ? 'active' : '' }}">
                <a href="{{ route('adoption.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-heart"></i>
                    <div data-i18n=" Adoption Listings"> Adoption Listings</div>
                </a>
            </li>

            {{-- Care Status --}}
            <li class="menu-item ">
                <a href="" class="menu-link">
                    <i class="menu-icon icon-base bx bx-first-aid"></i>
                    <div data-i18n=" Care Status"> Care Status</div>
                </a>
            </li>

            {{-- Adoption Requests --}}
            <li class="menu-item {{ Route::is('adoption-requests.index') ? 'active' : '' }}">
                <a href="{{ route('adoption-requests.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-message-check"></i>
                    <div data-i18n=" Adoption Requests"> Adoption Requests</div>
                </a>
            </li>

            <li class="menu-item {{ Route::is('adoption-requests.history') ? 'active' : '' }}">
                <a href="{{ route('adoption-requests.history') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-history"></i>
                    <div data-i18n=" Requests History"> Requests History</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('orders.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-cart-alt"></i>
                    <div data-i18n=" Orders"> Orders</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('products.*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-box"></i>
                    <div data-i18n="Products"> Products</div>
                </a>
            </li>
        @endcan

        @can('vet-view')
            {{-- ! Vaccines --}}
            <li class="menu-item {{ Route::is('appts.*') ? 'active' : '' }}">
                <a href="{{ route('appts.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-user-voice"></i>
                    <div data-i18n=" Veterinarians"> Appointments</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('health-records.index') ? 'active' : '' }}">
                <a href="{{ route('health-records.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-home-heart"></i>
                    <div data-i18n=" Animal Shelters">Health Record</div>
                </a>
            </li>
        @endcan

        @can('owner-view')
            {{-- ! Vaccines --}}
            <li class="menu-item ">
                <a href="{{ route('pets.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-user-voice"></i>
                    <div data-i18n=" Veterinarians"> My Pets</div>
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ route('health-records.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-home-heart"></i>
                    <div data-i18n=" Animal Shelters">Health Records</div>
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ route('appts.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-home-heart"></i>
                    <div data-i18n=" Animal Shelters">Appointments </div>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="{{ route('adoptions.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bxs-heart"></i>
                    <div data-i18n="Adoptions">Adoptions</div>
                </a>
            </li> --}}
            <li class="menu-item {{ Route::is('shop.index') ? 'active' : '' }}">
                <a href="{{ route('shop.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-shopping-bag"></i>
                    <div data-i18n="Products">Products</div>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="{{ route('adoptions.request') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-envelope"></i>
                    <div data-i18n="My Requests">My Requests</div>
                </a>
            </li> --}}
            {{-- Orders --}}
            <li class="menu-item">
                <a href="{{ route('orders.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-cart-alt"></i>
                    <div data-i18n="Orders">Orders</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('cart.index') }}" class="menu-link">
                    <i class="menu-icon icon-base bx bx-cart-alt"></i>
                    <div data-i18n="My Cart">My Cart</div>
                </a>
            </li>
        @endcan
        {{-- ! Profile --}}
        <li class="menu-item">
            <a href="#" class="menu-link d-flex align-items-center gap-2">
                <i class="menu-icon icon-base bx bx-bell fs-4 position-relative">
                    <!-- Notification Badge -->
                    <span
                        class="position-absolute top-0 start-100 translate-middle 
                         bg-danger text-white rounded-circle d-flex justify-content-center align-items-center"
                        style="font-size: 0.7rem; width: 18px; height: 18px;">
                        4
                    </span>
                </i>
                <span data-i18n="Notifications">Notifications</span>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Account</span>
        </li>
        {{-- ! Profile --}}
        <li class="menu-item ">
            <a href="{{ route('profile.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-home-heart"></i>
                <div data-i18n=" Animal Shelters">Profile</div>
            </a>
        </li>


        {{-- ! Logout --}}
        <li class="menu-item">
            <a href="{{ route('auth.logout') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-log-out"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>


    </ul>
</aside>
