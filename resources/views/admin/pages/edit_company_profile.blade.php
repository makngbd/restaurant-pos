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
                <a href="{{route('manage_company_profile')}}" class="btn btn-info"><i class="fa fa-building-o"></i> Company Profile</a>
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
                        <form action="{{ route('update_company_profile') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Company Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Company Name" name="company_name" value="{{$company_profile->company_name}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company Address :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Company Address" name="company_address" value="{{$company_profile->company_address}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company Email :</label>
                                <div class="controls">
                                    <input type="email" placeholder="Company Email" name="company_email" value="{{$company_profile->company_email}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company Phone :</label>
                                <div class="controls">
                                    <input type="tel" placeholder="Company Phone" name="company_phone" value="{{$company_profile->company_phone}}"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company VAT Reg. No. :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Company VAT Reg. No." name="company_vat_reg_no" value="{{$company_profile->company_vat_reg_no}}"/>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update Company Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection