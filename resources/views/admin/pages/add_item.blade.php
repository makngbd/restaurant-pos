@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Item</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_items')}}" class="btn btn-info"><i class="fa fa-bars"></i> Items</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-bars"></i> </span>
                        <h5>Add Item</h5>
                    </div>

                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div> <!-- end .flash-message -->


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
                        <form action="{{route('save_item')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Item Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Item Name" name="item_name" class="span6" required="" autofocus=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Unit</label>
                                <div class="controls">
                                    <select name="unit" class="span3" required="">
                                        <option value="kg">kg</option>
                                        <option value="litre">litre</option>
                                        <option value="piece">piece</option>
                                        <option value="pack">pack</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection