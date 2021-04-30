@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Edit Stock</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_stock')}}" class="btn btn-info"><i class="fa fa-industry"></i> Stock</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-industry"></i> </span>
                        <h5>Edit Stock</h5>
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
                        <form action="{{route('update_stock', ['id' => $stock->id])}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Select Item</label>
                                <div class="controls">
                                    <select name="item_id" class="span3" required="">
                                        @foreach($items as $item)
                                        <option value="{{$item->id}}" <?php if($item->id == $stock->item_id) echo 'selected' ?>>{{$item->item_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Quantity :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Quantity" name="quantity" class="span3" required="" min="1" value="{{$stock->quantity}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Unit</label>
                                <div class="controls">
                                    <select name="unit" class="span3" required="">
                                        <option value="gm" <?php if($stock->unit == 'gm') echo 'selected'; ?>>gm</option>
                                        <option value="kg" <?php if($stock->unit == 'kg') echo 'selected'; ?> selected="">kg</option>
                                        <option value="litre" <?php if($stock->unit == 'litre') echo 'selected'; ?>>litre</option>
                                        <option value="packet" <?php if($stock->unit == 'packet') echo 'selected'; ?>>packet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Total Price :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Total Price" name="total_price" class="span3" required="" min="0" value="{{$stock->total_price}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Remarks :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Remarks" name="remark" class="span3" value="{{$stock->remark}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date :</label>
                                <div class="controls">
                                    <input type="date" placeholder="Date" name="date" class="span3" required="" value="{{$stock->date}}"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection