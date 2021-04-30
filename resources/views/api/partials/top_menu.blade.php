
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="fa fa-user"></i>  <span class="text">Welcome {{Auth::user()->username}}</span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{route('my_profile')}}"><i class="fa fa-user"></i> My Profile</a></li>
                <li class="divider"></li>
                <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
        </li>

        @if(Auth::user()->role)
        <li <?php if (isset($menu_setting)) echo 'class="active"'; ?>><a title="" href="{{route('settings')}}"><i class="fa fa-cog"></i> <span class="text"> Settings</span></a></li>
        <li <?php if (isset($menu_company)) echo 'class="active"'; ?>><a title="" href="{{route('manage_company_profile')}}"><i class="fa fa-building-o"></i> <span class="text"> Company Profile</span></a></li>
        @endif
    </ul>
    <ul class="nav navbar-right">
        <li class=""><a title="" href="{{route('logout')}}"><i class="fa fa-sign-out"></i> <span class="text">Logout</span></a></li>
    </ul>
</div>

