@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Category</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_category')}}" class="btn btn-info"><i class="fa fa-tasks"></i> Manage Category</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
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
                        <form action="{{route('save_category')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Category Name" name="category_name" class="span3" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Parent Category</label>
                                <div class="controls">
                                    <select name="parent_category" class="span3">
                                        <option value="0">Root</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Publication Status</label>
                                <div class="controls">
                                    <label>
                                        <input type="radio" name="publication_status" value="1" required="" checked="">
                                        Published</label>
                                    <label>
                                        <input type="radio" name="publication_status" value="0">
                                        Unpublished</label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection