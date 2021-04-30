@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Warehouse Stock</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('add_stock')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New Stock</a>
                <a href="{{route('stock_entry_list')}}" class="btn btn-primary"><i class="fa fa-list"></i> Item Entry List</a>
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-industry"></i> </span>
                        <h5>Warehouse Stock ({{count($stocks)}} items)</h5>
                    </div>
                    @if(count($errors) > 0)
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">×</button>
                        @foreach($errors->all() as $error)
                        <p>
                            <strong>Error!</strong>  {{ $error }}
                        </p>
                        @endforeach
                    </div>
                    @endif
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                ?>
                                @foreach($stocks as $key => $stock)
                                <?php
                                $unit = App\Item::find($stock->item_id)->unit;
                                ?>
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$stock->item_name}}</td>
                                    <td style="text-align: center">{{$stock->quantity}} {{$unit}}</td>
                                </tr>
                                <?php
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')