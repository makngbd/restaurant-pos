@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Product</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_product')}}" class="btn btn-info"><i class="fa fa-tasks"></i> Manage Product</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-gift"></i> </span>
                        <h5>Add Product</h5>
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
                        <form action="{{route('save_product')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Product Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Product Name" name="product_name" class="span3" required="" value="{{old('product_name')}}" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Description :</label>
                                <div class="controls">
                                    <textarea name="product_description" class="span3"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Product Code" name="product_code" class="span3" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Price :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Product Price" name="product_price" class="span3" required="" min="0"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Discount :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Discount" name="product_discount" class="span3" value="0" required min="0"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Image :</label>
                                <div class="controls">
                                    <input type="file" name="product_image" accept="image/*" class="span3"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Category</label>
                                <div class="controls">
                                    <select name="product_category" class="span3" required="">
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
                                        <input type="radio" name="publication_status" value="1" required="" checked>
                                        Published</label>
                                    <label>
                                        <input type="radio" name="publication_status" value="0">
                                        Unpublished</label>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection