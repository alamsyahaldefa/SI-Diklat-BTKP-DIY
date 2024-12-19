<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: #343a40;">

  <!-- App Brand Section with White Background -->
  <div class="app-brand demo" style="background-color: #ffffff;">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        @include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @foreach ($menuData[0]->menu as $menu)

    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
    </li>

    @else

    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    if ($currentRouteName === $menu->slug) {
      $activeClass = 'active';
    }
    elseif (isset($menu->submenu)) {
      if (gettype($menu->slug) === 'array') {
        foreach($menu->slug as $slug){
          if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
            $activeClass = 'active open';
          }
        }
      }
      else{
        if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
          $activeClass = 'active open';
        }
      }
    }
    @endphp

    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}" style="color: #ffffff;"></i>
        @endisset
        <div style="color: #ffffff;">{{ isset($menu->name) ? __($menu->name) : '' }}</div>
        @isset($menu->badge)
          <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
        @endisset
      </a>

      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu',['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>

</aside>

<style>
  /* Sidebar styling */
  #layout-menu {
    background-color: #343a40 !important;
  }

  #layout-menu .menu-header-text {
    color: #ffffff !important;
  }

  #layout-menu .menu-item .menu-link {
    color: #ffffff !important;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  #layout-menu .menu-item .menu-link:hover {
    background-color: #495057 !important;
    color: #ffffff !important;
  }

  #layout-menu .menu-item.active .menu-link {
    background-color: #495057 !important;
    color: #ffffff !important;
  }

  .menu-inner-shadow {
    display: none;
  }
</style>
