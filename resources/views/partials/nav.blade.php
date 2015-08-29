<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{!! URL::to('/') !!}">Energien Plant</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--                <li class="{{ (Request::is('/') ? 'active' : '') }}">
                                    <a href="{!! URL::to('') !!}"><i class="fa fa-home"></i> Home</a>
                                </li>-->


                @if(Auth::check())
                @if(Auth::user()->hasRole('admin'))
                <li {{ (Request::is('admin/dashboard*') ? ' class=active' : '') }} >
                    <a href="{{url('admin/dashboard')}}">
                        <i class="fa fa-dashboard"></i><span
                            class="hidden-sm text"> Dashboard</span>
                    </a>
                </li>
                <li {{ (Request::is('admin/users*') ? ' class=active' : '') }} >
                    <a href="{{route('users')}}">
                        <i class="fa fa-users"></i><span
                            class="hidden-sm text"> Meine Kunden</span>
                    </a>
                </li>
                <li {{ (Request::is('admin/anlagenregister*') ? ' class=active' : '') }} >
                    <a href="{{route('anlagenregister')}}">
                        <i class="fa fa-bolt"></i><span
                            class="hidden-sm text"> Anlagenregister</span>
                    </a>
                </li>

                <li {{ (Request::is('admin/contact*') ? ' class=active' : '') }} >
                    <a href="{{route('contact')}}"><i class="fa fa-phone"></i> {{ \Lang::get('admin/contact.contact-form')}}</a>
                </li>

                <li {{ (Request::is('admin/settings*') ? ' class=active' : '') }} >
                    <a href="{{route('settings')}}">
                        <i class="fa fa-cogs"></i> Settings  
                    </a>
                </li>

                @else
                <li class="{{ (Request::is('user/contact') ? 'active' : '') }}">
                    <a href="{{url('user/contact')}}"><i class="fa fa-phone"></i> Contact</a>
                </li>
                <li class="{{ (Request::is('user/impressum') ? 'active' : '') }}">
                    <a href="{{url('user/impressum')}}"><i class="fa fa-info"></i> Impressum</a>
                </li>
                @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{!! URL::to('/') !!}"><i
                            class="fa fa-sign-in"></i> Login</a></li>
                <li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a
                        href="{!! URL::to('auth/register') !!}">Register</a></li>

                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <i
                            class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::check())
                        @if(Auth::user()->hasRole('admin'))

                        @endif
                        <!--<li role="presentation" class="divider"></li>-->
                        @endif
                        <li>
                            <a href="{!! URL::to('auth/logout') !!}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>