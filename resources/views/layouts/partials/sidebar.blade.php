<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">My POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if(Route::currentRouteName() === 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('suppliers.index') }}" class="nav-link @if(Route::currentRouteName() === 'suppliers.index' || Route::currentRouteName() === 'suppliers.create' || Route::currentRouteName() === 'suppliers.edit') active @endif">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Suppliers
                <span class="badge badge-info right">{{ \App\Models\Supplier::count() }}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('customers.index') }}" class="nav-link @if(Route::currentRouteName() === 'customers.index' || Route::currentRouteName() === 'customers.create' || Route::currentRouteName() === 'customers.edit') active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
                <span class="badge badge-info right">{{ \App\Models\Customer::count() }}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link @if(Route::currentRouteName() === 'categories.index' || Route::currentRouteName() === 'categories.create' || Route::currentRouteName() === 'categories.edit' || Route::currentRouteName() === 'units.index' || Route::currentRouteName() === 'units.create' || Route::currentRouteName() === 'units.edit' || Route::currentRouteName() === 'items.index' || Route::currentRouteName() === 'items.create' || Route::currentRouteName() === 'items.edit') active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link @if(Route::currentRouteName() === 'categories.index' || Route::currentRouteName() === 'categories.create' || Route::currentRouteName() === 'categories.edit') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('units.index') }}" class="nav-link @if(Route::currentRouteName() === 'units.index' || Route::currentRouteName() === 'units.create' || Route::currentRouteName() === 'units.edit') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('items.index') }}" class="nav-link @if(Route::currentRouteName() === 'items.index' || Route::currentRouteName() === 'items.create' || Route::currentRouteName() === 'items.edit') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Items</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link @if(Route::currentRouteName() === 'stocks.in.index' || Route::currentRouteName() === 'stocks.in.create' || Route::currentRouteName() === 'stocks.in.edit' || Route::currentRouteName() === 'stocks.out.index' || Route::currentRouteName() === 'stocks.out.create' || Route::currentRouteName() === 'stocks.out.edit') active @endif">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Transactions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sales.create') }}" class="nav-link @if(Route::currentRouteName() === 'sales.create' || Route::currentRouteName() === 'sales.create') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('stocks.in.index') }}" class="nav-link @if(Route::currentRouteName() === 'stocks.in.index' || Route::currentRouteName() === 'stocks.in.create' || Route::currentRouteName() === 'stocks.in.edit') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock In</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('stocks.out.index') }}" class="nav-link @if(Route::currentRouteName() === 'stocks.out.index' || Route::currentRouteName() === 'stocks.out.create' || Route::currentRouteName() === 'stocks.out.edit') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Out</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>

          <li class="nav-header">Setting</li>
          @role('admin')
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endrole

          {{-- logout --}}
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('form-logout').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form action="{{ route('logout') }}" method="post" id="form-logout">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>