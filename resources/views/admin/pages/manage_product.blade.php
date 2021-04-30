@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Manage Products</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a class="btn btn-success" href="{{route('add_product')}}"><i class="fa fa-plus"></i> Add Product</a>
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Products ({{count($products)}} Items)</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th  style="width: 40px; text-align: center;">Image</th>
                                    <th>Product Code</th>
                                    <th>Product Price (Tk)</th>
                                    <th>Discount (Tk)</th>
                                    <th>Product Category</th>
                                    <th>Publication Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td style="text-align: center"><img src="{{$product->product_image}}" alt="{{$product->product_name}}" width="40" height="40"></td>
                                    <td style="text-align: center">{{$product->product_code}}</td>
                                    <td style="text-align: right">{{$product->product_price}}</td>
                                    <td style="text-align: right">{{$product->product_discount}}</td>
                                    <?php 
                                    
                                    $category = App\Category::find($product->product_category);
                                    ?>
                                    @if($category)
                                    <td>{{$category->category_name}}</td>
                                    @else
                                    <td>root</td>
                                    @endif
                                    <td style="text-align: center">{{ ($product->publication_status) ? 'Published' : 'Unpublished' }}</td>
                                    <td style="text-align: center"> 
                                        <a class="tip" href="{{route('edit_product',['id' => $product->id])}}" data-original-title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 
                                        <a class="tip" href="{{route('delete_product',['id' => $product->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete {{$product->product_name}}?')"><i class="fa fa-remove"></i></a> 
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
