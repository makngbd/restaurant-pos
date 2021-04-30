@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Sales Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="" action="{{route('search_sales')}}" method="post">
                            {{csrf_field()}}
                            <div style="display: inline-block; vertical-align: middle;">
                                <label>Start Date : </label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$start_date}}">
                            </div>
                            <div  style="display: inline-block; vertical-align: middle;">
                                <label>End Date :</label>
                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$end_date}}">
                            </div>
                            <div style="display: inline-block; transform: translateY(7px)">
                            <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="fa fa-exchange"></i></span>
                        <h5>Sales Report</h5>
                    </div>
                    <div class="widget-content nopadding" style="overflow-x: auto">
                        <table class="table table-bordered data-table" style="min-width: 500px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price (Tk)</th>
                                    <th>Amount (Tk)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_sales =0; ?>
                                @foreach($sales as $key => $sale)
                                <tr class="gradeX">
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td style="text-align: center">{{$sale->product_code}}</td>
                                    <td>{{$sale->product_name}}</td>
                                    <td style="text-align: center">{{$sale->quantity}}</td>
                                    <td style="text-align: right">{{$sale->product_price}}</td>
                                    <td style="text-align: right">{{$sale->amount}}</td>
                                    <td style="text-align: center"><?php echo date('F d, Y', strtotime($sale->date)) ?></td>
                                </tr>
                                <?php $total_sales += $sale->amount ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 15px">
                        <h3>Total Sales : {{$total_sales}} /=</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
