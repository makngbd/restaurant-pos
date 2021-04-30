
<div id="breadcrumb"> 
    <a href="{{route('index')}}" title="Go to Home" class="tip-bottom"><i class="fa fa-home"></i> Home</a> 
    @if(isset($menu_dashboard))
    <a href="#" class="current">Dashboard</a>
    @elseif(isset($menu_profile))
    <a href="#" class="current">Profile</a>
    @elseif(isset($menu_category))
    <a href="#" class="current">Category</a>
    @elseif(isset($menu_product))
    <a href="#" class="current">Products</a>
    @elseif(isset($menu_order))
    <a href="#" class="current">Order</a>
    @elseif(isset($menu_invoice))
    <a href="#" class="current">Invoices</a>
    @elseif(isset($menu_user))
    <a href="#" class="current">Users</a>
    @elseif(isset($menu_sales))
    <a href="#" class="current">Sales</a>
    @elseif(isset($menu_cost))
    <a href="#" class="current">Costs</a>
    @elseif(isset($menu_setting))
    <a href="#" class="current">Settings</a>
    @elseif(isset($menu_report))
    <a href="#" class="current">Report</a>
    @endif
</div>
