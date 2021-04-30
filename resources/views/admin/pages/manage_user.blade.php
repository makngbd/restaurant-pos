@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Manage Users</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                 <a href="{{route('add_user')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add User</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
                        <h5>User-info</h5>
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
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr class="odd gradeX">
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->fname . " " . $user->lname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->role? "Admin": "User"}}</td>
                                    <td style="text-align: center"> 
                                        <a class="tip" href="{{route('edit_user',['id' => $user->id])}}" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 
                                        <a class="tip" href="{{route('change_password',['id' => $user->id])}}" data-original-title="Change Password"><i class="fa fa-key"></i></a> &nbsp; 
                                        
                                        @if($user->id != Auth::id())
                                        <a class="tip" href="{{route('delete_user',['id' => $user->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete {{$user->username}}?')"><i class="fa fa-remove"></i></a> 
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')