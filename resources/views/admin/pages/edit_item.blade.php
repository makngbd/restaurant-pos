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
                        <h5>Edit Item</h5>
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
                        <form action="{{route('update_item', ['id' => $item->id])}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Item Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Item Name" name="item_name" class="span6" required="" value="{{$item->item_name}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Unit</label>
                                <div class="controls">
                                    <select name="unit" class="span3" required="">
                                        <option value="kg" {{$item->unit == 'kg' ? 'selected': ''}}>kg</option>
                                        <option value="litre" {{$item->unit == 'litre' ? 'selected': ''}}>litre</option>
                                        <option value="piece" {{$item->unit == 'piece' ? 'selected': ''}}>piece</option>
                                        <option value="pack" {{$item->unit == 'packet' ? 'selected': ''}}>pack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection