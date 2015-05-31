<!--<div class="input-group">
    <input type="text" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">
            <i class="fa fa-search"></i>
        </button>
      </span>
</div>-->


<ul class="nav nav-pills nav-stacked" id="menu">
    <li {{ (Request::is('user/home') ? ' class=active' : '') }}>
        <a href="{{URL::to('user/home')}}"
                >
            <i class="fa fa-home fa-fw"></i><span class="hidden-sm text">
Home</span>
        </a>
    </li> 
    <li {{ (Request::is('user/profile') ? ' class=active' : '') }} >
        <a href="{{URL::to('user/profile')}}"
                >
            <i class="glyphicon glyphicon-user"></i><span
                    class="hidden-sm text"> Mein Profil</span>
        </a>
    </li>
     <li {{ (Request::is('user/anlagenregister*') ? ' class=active' : '') }} >
        <a href="{{URL::to('user/anlagenregister')}}"
                >
            <i class="fa fa-bolt"></i><span
                    class="hidden-sm text"> Anlagenregister</span>
        </a>
    </li>
</ul>
