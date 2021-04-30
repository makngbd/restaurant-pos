<div id="sidebar"><a href="{{route('dashboard')}}" class="visible-phone"><i class="icon fa fa-home"></i> Dashboard</a>
    <ul>
        <li <?php if (isset($menu_dashboard)) echo 'class="active"'; ?> ><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a> </li>

        <li <?php if (isset($menu_profile)) echo 'class="active"'; ?>> <a href="{{route('my_profile')}}"><i class="fa fa-address-card"></i> <span>My Profile</span></a> </li>
        @if(Auth::user()->role)
        <li <?php if (isset($menu_user)) echo 'class="active"'; ?>> <a href="{{route('manage_user') }} "><i class="fa fa-user"></i> <span>Users</span></a> </li>
        <li <?php if (isset($menu_setting)) echo 'class="active"'; ?>> <a href="{{route('settings') }} "><i class="fa fa-cog"></i> <span>Settings</span></a> </li>
        @endif
        <li <?php if (isset($menu_category)) echo 'class="active"'; ?>> <a href="{{route('manage_category') }} "><i class="fa fa-list-alt"></i> <span>Category</span></a> </li>
        <li <?php if (isset($menu_product)) echo 'class="active"'; ?>> <a href="{{route('manage_product') }} "><i class="fa fa-gift"></i> <span>Product</span></a> </li>
        <li <?php if (isset($menu_order)) echo 'class="active"'; ?>> <a href="{{route('order') }} "><i class="fa fa-first-order"></i> <span>Order</span></a> </li>
        <li <?php if (isset($menu_invoice)) echo 'class="active"'; ?>> <a href="{{route('invoice_list') }} "><i class="fa fa-files-o"></i> <span>Invoice</span></a> </li>
        <!--<li <?php if (isset($menu_cost)) echo 'class="active"'; ?>> <a href="{{route('manage_cost') }} "><i class="fa fa-money"></i> <span>Costs</span></a> </li>-->
        <li id="cost" class="submenu <?php if (isset($menu_cost)) echo 'open'; ?>" style="position: relative" onclick="changeCaret();"> <a href="#" ><i class="fa fa-usd"></i> <span>Costs</span> <i id="caret_cost" class="fa fa-caret-<?php if (isset($menu_cost)) echo 'down';
else echo 'right'; ?>" style="position:absolute; right: 0"></i></a>
            <ul>
                <li <?php if (isset($menu_salary_cost)) echo 'class="active"'; ?>><a href="{{route('manage_salary_cost')}}"><i class="fa fa-money"></i> Salary Cost</a></li>
                <li <?php if (isset($menu_equipment_cost)) echo 'class="active"'; ?>> <a href="{{route('manage_equipment_cost') }} "><i class="fa fa-cogs"></i> Equipment Cost</a> </li>
            </ul>
        </li>
        
        <li id="inventory" class="submenu <?php if (isset($menu_inventory)) echo 'open'; ?>" style="position: relative" onclick="changeCaret();"> <a href="#"><i class="fa fa-server"></i> <span>Inventory/Stock</span> <i id="caret_inventory" class="fa fa-caret-<?php if (isset($menu_inventory)) echo 'down';
else echo 'right'; ?>" style="position:absolute; right: 0"></i></a>
            <ul>
                <li <?php if (isset($menu_items)) echo 'class="active"'; ?>><a href="{{route('manage_items')}}"><i class="fa fa-bars"></i> Items</a></li>
                <li <?php if (isset($menu_stock)) echo 'class="active"'; ?>> <a href="{{route('manage_stock') }} "><i class="fa fa-industry"></i> Warehouse Stock</a> </li>
                <li <?php if (isset($menu_kitchen)) echo 'class="active"'; ?>> <a href="{{route('kitchen_stock') }} "><i class="fa fa-cutlery"></i> Kitchen Stock</a> </li>
                <li <?php if (isset($menu_damage)) echo 'class="active"'; ?>> <a href="{{route('damage_items') }} "><i class="fa fa-chain-broken"></i> Damage Items</a> </li>
            </ul>
        </li>
        <li id="report" class="submenu <?php if (isset($menu_report)) echo 'open'; ?>" style="position: relative" onclick="changeCaret();"> <a href="#" ><i class="fa fa-bar-chart"></i> <span>Report</span> <i id="caret_report" class="fa fa-caret-<?php if (isset($menu_report)) echo 'down';
else echo 'right'; ?>" style="position:absolute; right: 0"></i></a>
            <ul>
                <li <?php if (isset($menu_summary)) echo 'class="active"'; ?>><a href="{{route('summary_report')}}"><i class="fa fa-signal"></i> Summary Report</a></li>
                <li <?php if (isset($menu_sales)) echo 'class="active"'; ?>> <a href="{{route('sales') }} "><i class="fa fa-exchange"></i> Sales Report</a> </li>
                <li <?php if (isset($menu_cost_report)) echo 'class="active"'; ?>> <a href="{{route('cost_report') }} "><i class="fa fa-usd"></i> Costs Report</a> </li>
                <li <?php if (isset($menu_discount)) echo 'class="active"'; ?>> <a href="{{route('discount_report') }} "><i class="fa fa-tags"></i> Discount Report</a> </li>
                <li <?php if (isset($menu_warehouse_report)) echo 'class="active"'; ?>> <a href="{{route('warehouse_report') }} "><i class="fa fa-industry"></i> Warehouse Report</a> </li>
                <li <?php if (isset($menu_kitchen_report)) echo 'class="active"'; ?>> <a href="{{route('kitchen_report') }} "><i class="fa fa-cutlery"></i> Kitchen Report</a> </li>
                <li <?php if (isset($menu_damage_report)) echo 'class="active"'; ?>> <a href="{{route('damage_report') }} "><i class="fa fa-chain-broken"></i> Damage Report</a> </li>
            </ul>
        </li>
        

    </ul>
</div>
<script>
    
    function changeCaret(){
        var checkOpenReport = $('#report').hasClass('open');
        var checkOpenInventory = $('#inventory').hasClass('open');
        var checkOpenCost = $('#cost').hasClass('open');
        if(checkOpenReport){
            $('#caret_report').removeClass('fa-caret-right');
            $('#caret_report').addClass('fa-caret-down');
            
        }else{
            $('#caret_report').removeClass('fa-caret-down');
            $('#caret_report').addClass('fa-caret-right');
        }
        if(checkOpenInventory){
            $('#caret_inventory').removeClass('fa-caret-right');
            $('#caret_inventory').addClass('fa-caret-down');
            
        }else{
            $('#caret_inventory').removeClass('fa-caret-down');
            $('#caret_inventory').addClass('fa-caret-right');
        }
        if(checkOpenCost){
            $('#caret_cost').removeClass('fa-caret-right');
            $('#caret_cost').addClass('fa-caret-down');
            
        }else{
            $('#caret_cost').removeClass('fa-caret-down');
            $('#caret_cost').addClass('fa-caret-right');
        }
    }

</script>