@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Equipment Cost</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_equipment_cost')}}" class="btn btn-info"><i class="fa fa-cogs"></i> Equipment Cost</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-cogs"></i> </span>
                        <h5>Add Equipment Cost</h5>
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
                        <form action="{{route('save_equipment_cost')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Equipment Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Equipment Name" name="equipment_name" class="span6" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description :</label>
                                <div class="controls">
                                    <textarea name="description" class="span6"/></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Amount :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Amount" name="amount" class="span6" min="0" required=""/>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection