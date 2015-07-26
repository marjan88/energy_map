<!--<div class="input-group">
    <input type="text" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">
            <i class="fa fa-search"></i>
        </button>
      </span>
</div>-->


<ul class="nav nav-pills nav-stacked" id="menu">
<!--    <li {{ (Request::is('admin/dashboard') ? ' class=active' : '') }}>
        <a href="{{URL::to('admin/dashboard')}}"
                >
            <i class="fa fa-dashboard fa-fw"></i><span class="hidden-sm text">
Dashboard</span>
        </a>
    </li>-->
    
<!--    <li {{ (Request::is('admin/news*') ? ' class=active' : '') }}>
        <a href="#">
            <i class="glyphicon glyphicon-bullhorn"></i> News items<span
                    class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">
            <li {{ (Request::is('admin/newscategory') ? ' class=active' : '') }} >
                <a href="{{URL::to('admin/newscategory')}}">
                    <i class="glyphicon glyphicon-list"></i><span
                            class="hidden-sm text"> News categories </span>
                </a>
            </li>
            <li {{ (Request::is('admin/news') ? ' class=active' : '') }} >
                <a href="{{URL::to('admin/news')}}">
                    <i class="glyphicon glyphicon-bullhorn"></i><span
                            class="hidden-sm text"> News</span>
                </a>
            </li>
        </ul>
    </li>-->
   
    
    <li {{ (Request::is('admin/users*') ? ' class=active' : '') }} >
        <a href="{{URL::to('admin/users')}}"
                >
            <i class="glyphicon glyphicon-user"></i><span
                    class="hidden-sm text"> Meine Kunden</span>
        </a>
    </li>
     <li {{ (Request::is('admin/anlagenregister*') ? ' class=active' : '') }} >
        <a href="{{URL::to('admin/anlagenregister')}}"
                >
            <i class="fa fa-bolt"></i><span
                    class="hidden-sm text"> Anlagenregister</span>
        </a>
    </li>
    
    <li {{ (Request::is('admin/code*') ? ' class=active' : '') }} >
        <a href="{{URL::to('admin/code')}}"
                >
            <i class="fa fa-barcode"></i><span
                    class="hidden-sm text"> Registration Code</span>
        </a>
    </li>
<!--    <li  {{ (Request::is('admin/roles*') ? ' class=active' : '') }}>
        <a href="{{URL::to('admin/roles')}}"
                >
            <i class="glyphicon glyphicon-tasks"></i><span
                    class="hidden-sm text"> Roles</span>
        </a>
    </li>-->
</ul>
