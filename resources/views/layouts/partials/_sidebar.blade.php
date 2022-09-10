<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name ?? 'Login' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ class_active('categories') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('brands.index') }}" class="nav-link {{ class_active('brands') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('sizes.index') }}" class="nav-link  {{ class_active('sizes') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sizes</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link  {{ class_active('products') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('stocks') }}" class="nav-link  {{ class_active('stocks') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stocks</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('stockHistory') }}" class="nav-link  {{ class_active('stocks/history') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stocks History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('returnProducts') }}" class="nav-link  {{ class_active('return-products') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return Products</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('returnProductHistory') }}" class="nav-link  {{ class_active('return-products/history') }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return Products History</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>