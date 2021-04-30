@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Stock</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_stock')}}" class="btn btn-info"><i class="fa fa-industry"></i> Stock</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-industry"></i> </span>
                        <h5>Add Stock</h5>
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
                        <form action="{{route('save_stock')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Select Item</label>
                                <div class="controls">
                                    <select name="item_id" id="item" class="span3" required="">
                                        @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->item_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @foreach($items as $item)
                            <input type="hidden" id="unit{{$item->id}}" value="{{$item->unit}}">
                            @endforeach 
                            <div class="control-group">
                                <label class="control-label">Quantity :</label>
                                <div class="controls">
                                    <div class="input-append" style="width:100%;">
                                        <input type="number" step="0.001" placeholder="Quantity" class="span3" name="quantity" required=""/>
                                        <span class="add-on" id="unit"></span> 
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Total Price :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Total Price" name="total_price" class="span3" required="" min="0"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Remarks :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Remarks" name="remark" class="span3"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date :</label>
                                <div class="controls">
                                    <input type="date" placeholder="Date" name="date" class="span3" required="" value="<?php echo date('Y-m-d', strtotime('+6 hours')); ?>"/>
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
<script>
    $(window).load(function () {
        var valueSelected = $('#item').val();
        var unit = $('#unit' + valueSelected).val();
        $('#unit').text(unit);
    })
    $('#item').on('change', function (e) {
        var valueSelected = this.value;
        var unit = $('#unit' + valueSelected).val();
        $('#unit').text(unit);
    });

</script>
@endsection
