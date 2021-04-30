@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Summary Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form-inline" action="{{route('api_search_summary_report')}}" method="post">
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
                        <h5>Summary Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                            <thead>
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>Date</th>
                                    <th>Sales (Tk)</th>
                                    <th>Costs (Tk)</th>
                                    <th>Balance (Tk)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start_date = strtotime($start_date);
                                $end_date = strtotime($end_date);
                                $total_sales = 0;
                                $total_costs = 0;
                                for ($i = $start_date, $j = 0, $k = 0, $serial = 1; $i <= $end_date; $i = strtotime("+1 day", $i), $serial++) {
                                    $sale = 0;
                                    $cost = 0;
                                    echo '<tr>';
                                    echo '<td style="text-align:center">' . $serial . '</td>';
                                    echo '<td style="text-align:center">' . date('F d, Y', $i) . '</td>';
                                    if (isset($sales[$j])) {
                                        $date = strtotime($sales[$j]->date);
                                        if ($i == $date) {
                                            $sale = $sales[$j]->amount;
                                            echo '<td style="text-align:right">' . $sale . '</td>';
                                            $j++;
                                            $total_sales += $sale;
                                        } else {
                                            echo '<td style="text-align:right">0</td>';
                                        }
                                    } else {
                                        echo '<td style="text-align:right">0</td>';
                                    }
                                    if (isset($costs[$k])) {
                                        $date = strtotime($costs[$k]->date);
                                        if ($i == $date) {
                                            $cost = $costs[$k]->amount;
                                            echo '<td style="text-align:right">' . $cost . '</td>';
                                            $k++;
                                            $total_costs += $cost;
                                        } else {
                                            echo '<td style="text-align:right">0</td>';
                                        }
                                    } else {
                                        echo '<td style="text-align:right">0</td>';
                                    }
                                    echo '<td style="text-align:right">' . ($sale - $cost) . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                <tr>
                                    <th style="text-align:center;"></th>
                                    <th style="text-align:center;">{{date('F d, Y',$start_date)}} - {{date('F d, Y',$end_date)}}</th>
                                    <th style="text-align:right;">Total Sales : {{$total_sales}}</th>
                                    <th style="text-align:right;">Total Costs : {{$total_costs}}</th>
                                    <th style="text-align:right;">Balance : {{($total_sales-$total_costs)}}</th>
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
