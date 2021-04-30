@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')
<?php
?>

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Summary Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="" action="{{route('search_summary_report')}}" method="post">
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
                        <h5>Summary Report</h5>
                    </div>
                    <div class="widget-content nopadding" style="overflow-x: auto">
                        <table class="table table-bordered" style="min-width: 500px">
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
                                    <th style="font-size: 18px;"></th>
                                    <th style="font-size: 18px;"><h3>{{date('F d, Y',$start_date)}} - {{date('F d, Y',$end_date)}}</h3></th>
                                    <th style="text-align:right;"><h3>Total Sales : {{$total_sales}}</h3></th>
                                    <th style="text-align:right;"><h3>Total Costs : {{$total_costs}}</h3></th>
                                    <th style="text-align:right;"><h3>Balance : {{($total_sales-$total_costs)}}</h3></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
