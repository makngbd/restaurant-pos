<div id="sidebar"><a href="{{route('dashboard')}}" class="visible-phone"><i class="icon fa fa-home"></i> Dashboard</a>
    <ul>
        <li <?php if (isset($menu_dashboard)) echo 'class="active"'; ?> ><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a> </li>

        <li <?php if (isset($menu_profile)) echo 'class="active"'; ?>> <a href="{{route('my_profile')}}"><i class="fa fa-address-card"></i> <span>My Profile</span></a> </li>
        <li <?php if (isset($menu_category)) echo 'class="active"'; ?>> <a href="{{route('manage_category') }} "><i class="fa fa-list-alt"></i> <span>Category</span></a> </li>
        <li <?php if (isset($menu_product)) echo 'class="active"'; ?>> <a href="{{route('manage_product') }} "><i class="fa fa-gift"></i> <span>Product</span></a> </li>
        <li <?php if (isset($menu_order)) echo 'class="active"'; ?>> <a href="{{route('order') }} "><i class="fa fa-first-order"></i> <span>Order</span></a> </li>
        <li <?php if (isset($menu_invoice)) echo 'class="active"'; ?>> <a href="{{route('invoice_list') }} "><i class="fa fa-files-o"></i> <span>Invoice</span></a> </li>
        @if(Auth::user()->role)
        <li <?php if (isset($menu_user)) echo 'class="active"'; ?>> <a href="{{route('manage_user') }} "><i class="fa fa-user"></i> <span>Users</span></a> </li>
        <li <?php if (isset($menu_sales)) echo 'class="active"'; ?>> <a href="{{route('sales') }} "><i class="fa fa-exchange"></i> <span>Sales</span></a> </li>
        <li <?php if (isset($menu_cost)) echo 'class="active"'; ?>> <a href="{{route('manage_cost') }} "><i class="fa fa-money"></i> <span>Costs</span></a> </li>
        <li <?php if (isset($menu_setting)) echo 'class="active"'; ?>> <a href="{{route('settings') }} "><i class="fa fa-cog"></i> <span>Settings</span></a> </li>
        <li class="submenu <?php if (isset($menu_report)) echo 'open'; ?>"> <a href="#"><i class="fa fa-bar-chart"></i> <span>Report</span> <span class="label label-important">3</span></a>
            <ul>
                <li <?php if (isset($menu_summary)) echo 'class="active"'; ?>><a href="{{route('summary_report')}}">Summary Report</a></li>
                <li><a href="">Submenu</a></li>
                <li><a href="">Submenu</a></li>
            </ul>
        </li>
        @endif

    </ul>
</div>