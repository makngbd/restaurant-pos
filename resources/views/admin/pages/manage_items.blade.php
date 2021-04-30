@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Manage Items</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('add_item')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New Item</a>
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-list-alt"></i> </span>
                        <h5>Manage Items ({{count($items)}} items)</h5>
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
                    @isset($success)
                    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Success!</h4>
                        {{$success}}
                    </div>
                    @endisset
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                ?>
                                @foreach($items as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td style="text-align: center"> 
                                        <a class="tip" href="{{route('edit_item',['id' => $item->id])}}" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 
                                        <a class="tip" href="{{route('delete_item',['id' => $item->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete {{$item->item_name}}?')"><i class="fa fa-remove"></i></a> 
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