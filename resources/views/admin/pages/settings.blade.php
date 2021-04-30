@extends('admin.layouts.admin_master')
@section('admin_main_content')
<?php 
use App\Setting;
$settings = Setting::all()->last();

?>
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Settings</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-list-alt"></i> </span>
                        <h5>Settings</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Discount Type</th>
                                    <td>{{($settings->discount_type) ? "Product Wise" : "Overall"}}</td>
                                </tr>
                                <tr>
                                    <th>Overall Discount</th>
                                    <td>{{$settings->discount}}%</td>
                                </tr>
                                <tr>
                                    <th>Discount Deadline</th>
                                    <td>{{$settings->discount_deadline}}</td>
                                </tr>
                                <tr>
                                    <th>VAT</th>
                                    <td>{{$settings->vat}}%</td>
                                </tr>
                                <tr>
                                    <th>Service Charge</th>
                                    <td>{{$settings->service_charge}}%</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{route('change_settings')}}" class="btn btn-success"><i class="fa fa-edit"></i> Change Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection