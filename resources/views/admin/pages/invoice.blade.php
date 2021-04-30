@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Invoice</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <a href="{{route('invoice_list')}}" class="btn btn-info"><i class="fa fa-list"></i> Invoice List</a>
        <a href="{{route('order')}}" class="btn btn-success"><i class="fa fa-first-order"></i> Order</a>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <div id="print_area">
                            <table align="center" style="margin-bottom: 25px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h4>{{$company_profile->company_name}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{$company_profile->company_address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone : {{$company_profile->company_phone}}</td>
                                    </tr>
                                    @if($company_profile->company_vat_reg_no)
                                    <tr>
                                        <td>VAT Reg# {{$company_profile->company_vat_reg_no}}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>Inv# {{$order->invoice_number}}</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo date('F d, Y', strtotime($order->date)) ?></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="row-fluid">
                                <div class="span12">
                                    <table class="table table-bordered table-invoice-full">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;" class="head0">#</th>
                                                <th class="head1">Particulars</th>
                                                <th style="width: 30px" class="head0 right">Qty</th>
                                                <th style="width: 50px" class="head1 right">Price</th>
                                                <th style="width: 100px" class="head0 right">Amount(Tk)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $serial = 0; ?>
                                            @foreach($sales as $product)
                                            <tr>
                                                <td style="text-align: center;">{{++$serial}}</td>
                                                <td>{{$product->product_name}}</td>
                                                <td style="text-align: center;">{{$product->quantity}}</td>
                                                <td style="text-align: right;">{{$product->product_price}}</td>
                                                <td style="text-align: left;"><strong>{{$product->amount}}</strong></td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" style="text-align: right">Subtotal : </td>
                                                <td style="text-align: left"><strong>{{$order->subtotal}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right">Discount : </td>
                                                <td style="text-align: left"><strong>{{$order->discount}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right">VAT : </td>
                                                <td style="text-align: left"><strong>{{$order->vat}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right">Service Charge : </td>
                                                <td style="text-align: left"><strong>{{$order->service_charge}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right; font-size: 16px"><strong>Grand Total</strong> </td>
                                                <td style="text-align: left"><strong>{{$order->grand_total}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right; font-size: 16px">Extra Discount</td>
                                                <td style="text-align: left"><strong>{{$order->extra_discount | 0}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right">Receive Amount : </td>
                                                <td style="text-align: left"><strong>{{$order->receive_amount}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: right">Return Amount : </td>
                                                <td style="text-align: left"><strong>{{$order->return_amount}}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-center" style="font-size: 12px">
                                        <!--<p>Address : {{$company_profile->company_address}}</p>-->
                                        <p>Developed by makNgBd</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary btn-large pull-right" href="" onclick="print_content()"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function print_content() {
        var restore_page = document.body.innerHTML;
        document.body.style.fontSize = '14px';
        document.getElementById('print_area').style.width = '100px';
        document.getElementById('print_area').style.height = '200px';
        var print_content = document.getElementById('print_area').innerHTML;
        document.body.innerHTML = print_content;
        window.print();
        document.body.innerHTML = restore_page;
    }
</script>
@endsection