@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>My Profile</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
                        <h5>User-info : {{Auth::user()->username}}</h5>
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
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td>{{Auth::user()->fname}}</td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td>{{Auth::user()->lname}}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{Auth::user()->username}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{Auth::user()->email}}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{Auth::user()->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{Auth::user()->role? "Admin": "User"}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{route('edit_profile')}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Profile</a>
                    <a href="{{route('change_my_password')}}" class="btn btn-info"><i class="fa fa-key"></i> Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection