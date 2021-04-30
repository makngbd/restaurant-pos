@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Costs</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_cost')}}" class="btn btn-info"><i class="fa fa-money"></i> Cost</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-money"></i> </span>
                        <h5>Add Category</h5>
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
                        <h4 class="alert-heading">{{$success}}</h4>
                    </div>
                    @endisset
                    <div class="widget-content nopadding">
                        <form action="{{route('save_cost')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Supplier :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Supplier" name="supplier" class="span6" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Particulars :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Particulars" name="particular" class="span6" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Amount :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Amount" name="amount" class="span6" min="0" max="100000" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date :</label>
                                <div class="controls">
                                    <input type="date" name="date" class="span6" required=""/>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Cost</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection