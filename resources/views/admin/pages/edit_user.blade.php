@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Edit User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_user')}}" class="btn btn-info">Manage User</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
                        <h5>Add User-info</h5>
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
                        <form action="{{route('update_user',['id' => $user->id])}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">First Name :</label>
                                <div class="controls">
                                    <input type="text"  placeholder="First name" name="fname" value="{{$user->fname}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Last name" name="lname" value="{{$user->lname}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input type="text" placeholder="Username" name="username" value="{{$user->username}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" placeholder="email@example.com" name="email" value="{{$user->email}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone Number</label>
                                <div class="controls">
                                    <input type="number" placeholder="Phone Number" name="phone" value="{{$user->phone}}" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User Role</label>
                                <div class="controls">
                                    <label>
                                        <input type="radio" name="role" value="1" required="" {{$user->role ? "checked" : ""}}/>
                                        Admin</label>
                                    <label>
                                        <input type="radio" name="role" value="0" {{$user->role ? "" : "checked"}}/>
                                        User</label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection