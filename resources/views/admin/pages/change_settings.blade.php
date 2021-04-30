@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Change Settings</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('settings')}}" class="btn btn-info"><i class="fa fa-cog"></i> Settings</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-cog"></i> </span>
                        <h5>Change Settings</h5>
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
                        <form action="{{ route('update_settings') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Discount Type</label>
                                <div class="controls">
                                    <label>
                                        <input type="radio" name="discount_type" value="0" {{($settings->discount_type) ? "" : "checked"}}/>
                                        Overall</label>
                                    <label>
                                        <input type="radio" name="discount_type" value="1" {{($settings->discount_type) ? "checked" : ""}}/>
                                        Product Wise</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Overall Discount :</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="number" name="discount" placeholder="Discount" value="{{$settings->discount}}" max="100" min="0">
                                        <span class="add-on">%</span> </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Discount Deadline :</label>
                                <div class="controls">
                                    <input type="date" placeholder="Discount Deadline" name="discount_deadline" value="{{$settings->discount_deadline}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">VAT :</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="number" name="vat" placeholder="VAT" value="{{$settings->vat}}" max="100" min="0">
                                        <span class="add-on">%</span> </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Service Charge :</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input type="number" name="service_charge" placeholder="Service Charge" value="{{$settings->service_charge}}" max="100" min="0">
                                        <span class="add-on">%</span> </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection