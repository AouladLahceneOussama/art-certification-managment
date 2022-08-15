<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ admin_url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{!! config('admin.logo-mini', config('admin.name')) !!}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!! config('admin.logo', config('admin.name')) !!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <ul class="nav navbar-nav hidden-sm visible-lg-block">
        {!! Admin::getNavbar()->render('left') !!}
        </ul>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                {!! Admin::getNavbar()->render() !!}

                <!-- User Account Menu -->
                
                        <!-- The user image in the menu -->
                        <li >
                           <a href="{{ admin_url('auth/setting') }}" class=""  style = "text-decoration: none; font-size: 16px"> <abbr title="{{ trans('admin.setting') }}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> </abbr></a>
                              </li>      <li><a href="{{ admin_url('auth/logout') }}" class="" style = "text-decoration: none; font-size: 16px"> <abbr title=" {{ trans('admin.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></abbr></a>
                        
                    </li> 
                <!-- Control Sidebar Toggle Button -->
                {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>