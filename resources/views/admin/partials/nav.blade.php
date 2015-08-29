<ul class="nav nav-pills nav-stacked" id="menu">

   
    
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
<?php /*    <li  {{ (Request::is('admin/roles*') ? ' class=active' : '') }}>
        <a href="{{URL::to('admin/roles')}}"
                >
            <i class="glyphicon glyphicon-tasks"></i><span
                    class="hidden-sm text"> Roles</span>
        </a>
    </li> */ ?>
</ul>
