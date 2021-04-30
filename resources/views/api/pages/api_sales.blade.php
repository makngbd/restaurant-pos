@include('api.partials.header')
<?php
?>

<div id="content">
    <div id="content-header">
        <h1>Sales Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form-inline" action="{{route('api_search_sales')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Start Date : </label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$start_date}}">
                            </div>
                            <div class="form-group">
                                <label>End Date :</label>
                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$end_date}}">
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="fa fa-exchange"></i></span>
                        <h5>Sales Report ({{count($sales)}} data found)</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price (Tk)</th>
                                    <th>Amount (Tk)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $key => $sale)
                                <tr class="gradeX">
                                    <td style="text-align: center;">{{$key+1}}</td>
                                    <td style="text-align: center;">{{$sale->product_code}}</td>
                                    <td>{{$sale->product_name}}</td>
                                    <td style="text-align: center;">{{$sale->quantity}}</td>
                                    <td style="text-align: right;">{{$sale->product_price}}</td>
                                    <td style="text-align: right;">{{$sale->amount}}</td>
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

@include('api.partials.footer')
