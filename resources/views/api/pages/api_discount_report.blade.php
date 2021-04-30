@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Discount Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form" action="{{route('api_search_discount_report')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label">Start Date : </label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$start_date}}">
                            </div>
                            <div class="form-group">
                                <label>End Date :</label>
                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$end_date}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Select Reference :</label>
                                <select name="discount_reference">
                                    <option value="0">All References</option>
                                    @foreach($references as $reference)
                                    <option value="{{$reference->discount_reference}}" <?php if ($reference->discount_reference == $reference_name) echo 'selected'; ?>>{{$reference->discount_reference}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default btn-block">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="fa fa-exchange"></i></span>
                        <h5>Discount Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                             <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No.</th>
                                    <th>Grand Total (Tk)</th>
                                    <th>Discount (Tk)</th>
                                    <th>Extra Discount (Tk)</th>
                                    <th>Reference Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_grand = 0;
                                $total_discount = 0;
                                $total_extra_discount = 0;
                                ?>
                                @foreach($orders as $key => $order)
                                <tr class="gradeX">
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td style="text-align: center">{{$order->invoice_number}}</td>
                                    <td style="text-align: right">{{$order->grand_total}}</td>
                                    <td style="text-align: right">{{$order->discount}}</td>
                                    <td style="text-align: right">{{$order->extra_discount}}</td>
                                    <td style="text-align: left">{{$order->discount_reference}}</td>
                                </tr>
                                <?php
                                $total_grand += $order->grand_total;
                                $total_discount += $order->discount;
                                $total_extra_discount += $order->extra_discount;
                                ?>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td><h3>Total :</h3></td>
                                    <td style="text-align: right"><h3>{{$total_grand}}</h3></td>
                                    <td style="text-align: right"><h3>{{$total_discount}}</h3></td>
                                    <td style="text-align: right"><h3>{{$total_extra_discount}}</h3></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('api.partials.footer')
