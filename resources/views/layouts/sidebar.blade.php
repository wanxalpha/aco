<!DOCTYPE html>
<html lang="en">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ACO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            $segment = Request::segment(1);
            $segment2 = Request::segment(2);
          ?>     
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link 
              @if(!$segment || $segment=='home')
              active
              @endif
              ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          @if(Auth::user()->role == '0')
            <li class="nav-item">
              <a href="{{ route('merchant.index') }}" class="nav-link 
                @if($segment=='merchant')
                active
                @endif">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Merchant
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('partner.index') }}" class="nav-link 
                @if($segment=='partner')
                active
                @endif">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Partner
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="" class="nav-link 
                    @if($segment=='settings')
                    active
                    @endif">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Settings
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="@if($segment=='settings')
                  display: block;
                  @endif">
                <li class="nav-item">
                  <a href="{{ route('setting.merchant.category.index') }}" class="nav-link
                    @if($segment2=='merchant_category')
                    active
                    @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Merchant Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('setting.product.category.index') }}" class="nav-link
                    @if($segment2=='product_category')
                    active
                    @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/editors.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Editors</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/forms/validation.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Validation</p>
                  </a>
                </li>
              </ul>
            </li>
          @elseif(Auth::user()->role == '1')
            <li class="nav-item">
              <a href="{{ route('merchant.product.index') }}" class="nav-link 
                @if($segment=='merchant_product')
                active
                @endif">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Product
                </p>
              </a>
            </li>
          @elseif(Auth::user()->role == '2')
          <li class="nav-item">
            <a href="{{ route('insurance.index') }}" class="nav-link 
              @if($segment=='insurance')
              active
              @endif">
              <i class="nav-icon fa fa-th"></i>
              <p>
                Insurance
              </p>
            </a>
          </li>
          @endif
          <li class="nav-header">Action</li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
           
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</body>
</html>
