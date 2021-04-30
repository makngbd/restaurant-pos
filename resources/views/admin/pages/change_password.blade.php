@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Change Password</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_user')}}" class="btn btn-info">Manage User</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-info-sign"></i> </span>
                        <h5>Change Password : {{$user->username}}</h5>
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
                        {{$success}}
                    </div>
                    @endisset
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{route('update_password', ['id'=> $user->id])}}" name="password_validate" id="password_validate" novalidate="novalidate">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" name="password" id="pwd">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Confirm password</label>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" id="pwd2">
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Update Password" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection