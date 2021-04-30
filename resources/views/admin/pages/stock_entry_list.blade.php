@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Stock Entry List</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_stock')}}" class="btn btn-info"><i class="fa fa-industry"></i> Warehouse Stock</a>
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-industry"></i> </span>
                        <h5>Stock Entry List</h5>
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
                                    <th>Entry By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                ?>
                                @foreach($stocks as $key => $stock)
                                <?php
                                $unit = App\Item::find($stock->item_id)->unit;
                                $username = App\User::find($stock->created_by)->username;
                                ?>
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$stock->item_name}}</td>
                                    <td style="text-align: center">{{$stock->quantity}} {{$unit}}</td>
                                    <td style="text-align: center">{{$username}}</td>
                                    <td style="text-align: center"> 
                                        <a class="tip" href="{{route('delete_stock',['id' => $stock->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-remove"></i></a> 
                                    </td>
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