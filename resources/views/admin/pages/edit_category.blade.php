@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Edit Category</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_category')}}" class="btn btn-info">Manage Category</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
                        <h5>Edit Category</h5>
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
                        <form action="{{route('update_category',['id' => $category->id])}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Category Name" name="category_name" value="{{ $category->category_name }}" class="span3" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Parent Category</label>
                                <div class="controls">
                                    <select name="parent_category" class="span3">
                                        <option value="0">Root</option>
                                        @foreach($categories as $cate)
                                            @if($category->id != $cate->id)
                                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Publication Status</label>
                                <div class="controls">
                                    <label>
                                        <input type="radio" name="publication_status" value="1" required="" {{ ($category->publication_status) ? 'checked' : '' }}>
                                        Published</label>
                                    <label>
                                        <input type="radio" name="publication_status" value="0" {{ ($category->publication_status) ? '' : 'checked' }}>
                                        Unpublished</label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection