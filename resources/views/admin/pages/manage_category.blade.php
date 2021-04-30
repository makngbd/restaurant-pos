@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Manage Category</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                 <a href="{{route('add_category')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add Category</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-list-alt"></i> </span>
                        <h5>Categories  ({{count($categories)}} Items)</h5>
                    </div>
                    <div class="flash-message" style="margin-top: 20px">
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
                                    <th>Category Name</th>
                                    <th>Parent Category</th>
                                    <th>Publication Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                <tr class="odd gradeX">
                                    <td style="text-align: center;">{{++$key}}</td>
                                    <td>{{$category->category_name}}</td>
                                    @if($category->parent_category)
                                    <td>{{App\Category::find($category->parent_category)->category_name}}</td>
                                    @else
                                    <td>root</td>
                                    @endif
                                    <td style="text-align: center;">{{ ($category->publication_status) ? 'Published' : 'Unpublished' }}</td>
                                    <td style="text-align: center"> 
                                        <a class="tip" href="{{route('edit_category',['id' => $category->id])}}" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 
                                        <a class="tip" href="{{route('delete_category',['id' => $category->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-remove"></i></a> 
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