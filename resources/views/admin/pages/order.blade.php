@extends('admin.layouts.admin_master')
@section('admin_main_content')
<?php
$settings = App\Setting::all()->last();
$orders = App\TempOrder::where('user_id', Auth::id())->get();
?>

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Order</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="text-right">
                    <a href="#" class="btn btn-warning show_extra_discount_area"><i class="fa fa-plus"></i> Extra Discount</a>
                </div>
                <div class="widget-box">
                    @if(count($errors) > 0)
                    <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">×</button>
                        @foreach($errors->all() as $error)
                        <p>
                            <strong>Error!</strong> {{ $error }}
                        </p>
                        @endforeach
                    </div>
                    @endif
                    @isset($error)
                    <div class="alert alert-danger alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$error}}</h4>
                    </div>
                    @endisset
                    @isset($success)
                    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$success}}</h4>
                    </div>
                    @endisset

                    <div class="widget-content nopadding">
                        <form action="{{route('add_item_to_order')}}" method="post" class="form-horizontal" id="myform">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label"><i class="fa fa-search"></i> <b>Search Product :</b></label>
                                <div class="controls">
                                    <input type="text" placeholder="Product Name / Code" id="search_product" name="search_product" class="span10 enterKey" autofocus="" />
                                    <input type="number" id="quantity" name="quantity" value="1" class="span2 enterKey" min="1" max="10000" />
                                    <input type="hidden" id="product_id" name="product_id" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-gift"></i> </span>
                        <h5>Order</h5>
                    </div>

                    <div class="widget-content nopadding table-responsive">
                        @if($orders->count())
                        <form action="{{ route('process_order') }}" method="post">
                            {{csrf_field()}}
                            <table class="table table-bordered table-striped" style="">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">Action</th>
                                        <th style="width: 20px;">#</th>
                                        <th style="width: 100px;">Product Code</th>
                                        <th>Product Name</th>
                                        <th style="width: 100px;">Quantity</th>
                                        <th style="width: 100px;">Discount</th>
                                        <th style="width: 100px;">Unit Price</th>
                                        <th style="width: 150px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $serial = 0;
                                    $total_product_discount = 0;
                                    ?>
                                    @foreach($orders as $order)
                                    <tr>
                                        <?php
                                        $product = App\Product::find($order->product_id);
                                        $product_code = $product->product_code;
                                        $product_name = $product->product_name;
                                        $quantity = $order->quantity;
                                        $product_discount = $product->product_discount;
                                        $price = $product->product_price;
                                        $total = $product->product_price * $order->quantity;
                                        $total_product_discount += $product_discount * $quantity;
                                        $subtotal += $total;
                                        ?>
                                        <td style="text-align: center;"><a href="{{route('remove_item_from_order', ['id' => $order->id])}}" class="tip-top" data-original-title="Remove"><i class="fa fa-remove"></i></a></td>
                                        <td style="text-align: center;">{{++$serial}}</td>
                                        <td style="text-align: center;">{{$product_code}}</td>
                                        <td>{{$product_name}}</td>
                                        <td style="text-align: right;">{{$quantity}}</td>
                                        <td style="text-align: right;">{{$product_discount . " X " . $quantity . " = " . $product_discount*$quantity}}</td>
                                        <td style="text-align: right;">{{$price}} /=</td>
                                        <td style="text-align: right;">{{$total}} /=</td>
                                    </tr>

                                    @endforeach
                                    <?php
                                    if (!$settings->discount_type) {
                                        $discount = 0;
                                        if ($settings->discount_deadline > date('Y-m-d')) {
                                            $discount = ($settings->discount / 100) * $subtotal;
                                        }
                                    } else {
                                        $discount = $total_product_discount;
                                    }
                                    $vat = ($settings->vat / 100) * $subtotal;
                                    $service_charge = ($settings->service_charge / 100) * $subtotal;
                                    $grand_total = ($subtotal + $vat + $service_charge) - $discount;
                                    ?>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Sub Total</td>
                                        <td style="text-align: right;">{{$subtotal}} /=</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Discount :
                                            @if(Auth::user()->role)
                                            <a href="{{route('change_settings')}}" title="Change Settings"><span class="label label-inverse">{{ $settings->discount_type ? "Product Wise" : "Overall"}}</span></a>
                                            @else
                                            <span class="label label-inverse">{{ $settings->discount_type ? "Product Wise" : "Overall"}}</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">{{$discount}} /=</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">VAT</td>
                                        <td style="text-align: right;">{{$vat}} /=</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Service Charge</td>
                                        <td style="text-align: right;">{{$service_charge}} /=</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;"><b>Grand Total</b></td>
                                        <td style="text-align: right;"><b><span id="grand_total">{{$grand_total}}</span> /=</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" value="0" id="check_extra_discount" name="check_extra_discount">
                                        </td>
                                    </tr>
                                    <tr class="extra_discount_area" style="display: none;">
                                        <td colspan="7" style="text-align: right;"><span style="color: #F89406;">Extra Discount</span></td>
                                        <td style="text-align: right;"><input style="text-align: right; margin: 0;" type="number" id="extra_discount" name="extra_discount" class="form-control calculate"></td>
                                    </tr>
                                    <tr class="extra_discount_area" style="display: none;">
                                        <td colspan="7" style="text-align: right;"><span style="color: #F89406;">Discount Reference</span></td>
                                        <td style="text-align: left;"><input style="margin: 0;" type="text" id="discount_reference" name="discount_reference" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Recieve Amount</td>
                                        <td style="text-align: right;"><input style="text-align: right; margin: 0;" type="number" id="receive_amount" name="receive_amount" class="form-control calculate" required=""></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: right;">Return Amount</td>
                                        <td style="text-align: right;"><span id="return_amount"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="grand_total" value="{{$grand_total}}">
                            <div class="form-actions text-right">
                                <a href="{{route('cancel_order')}}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel Order</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-first-order"></i> Process Order</button>
                            </div>
                        </form>
                        @else
                        <div class="widget-content">
                            <div class="alert alert-block text-center alert-success"> <a class="close" data-dismiss="alert" href="#">×</a>
                                <h4 class="alert-heading">Empty Orders</h4>
                                There has no items to order
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('admin/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('admin/js/jquery-ui.js')}}"></script>
<script>
    //$(document).ready(function () {
    $('#search_product').autocomplete({
        source: "{{route('search')}}",
        minlength: 1,
        autoFocus: true,
        select: function(e, ui) {
            $('#product_id').val(ui.item.id);
        }
    });

    $('.enterKey').keypress(function(e) {
        if (e.which === 13) {
            $('#myform').submit();
        }
    });
    $('.calculate').bind('keyup mouseup', function() {
        calculate();
    });
    $('.show_extra_discount_area').click(function() {
        $('#extra_discount').val('');
        $('.extra_discount_area').slideToggle('slow');
        $('.show_extra_discount_area i').toggleClass("fa-plus fa-minus");
        if ($('#extra_discount').attr('required')) {
            $('#extra_discount').attr('required', false);
            $('#discount_reference').attr('required', false);
            $('#check_extra_discount').val(0);
        } else {
            $('#extra_discount').attr('required', true);
            $('#discount_reference').attr('required', true);
            $('#check_extra_discount').val(1);
        }
        calculate();
    });

    function calculate() {
        var receive_amount = $('#receive_amount').val() | 0;
        var grand_total = parseFloat($('#grand_total').html());
        var extra_discount = parseFloat($('#extra_discount').val()) | 0;
        var return_amount = Math.round((receive_amount + extra_discount - grand_total) * 100) / 100;
        $('#return_amount').html(return_amount + " /=");
    }
    //});
</script>
@endsection