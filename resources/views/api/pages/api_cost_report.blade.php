@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Costs Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form" action="{{route('api_search_cost_report')}}" method="post">
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
                                <label>Cost Type :</label>
                                <select name="cost_type">
                                    <option value="">All Types</option>
                                    <option value="Stock" <?php if($cost_type == 'Stock') echo 'selected'; ?>>Stock</option>
                                    <option value="Salary" <?php if($cost_type == 'Salary') echo 'selected'; ?>>Salary</option>
                                    <option value="Equipment" <?php if($cost_type == 'Equipment') echo 'selected'; ?>>Equipment</option>
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
                        <h5>Costs Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                             <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cost Type</th>
                                    <th>Title</th>
                                    <th>Amount (Tk)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_amount = 0;
                                ?>
                                @foreach($costs as $key => $cost)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td style="text-align: center">{{$cost->cost_type}}</td>
                                    <td style="text-align: center">{{$cost->title}}</td>
                                    <td style="text-align: right">{{$cost->amount}}</td>
                                    <td style="text-align: center"><?php echo date('F d, Y', strtotime($cost->date)) ?></td>
                                </tr>
                                <?php
                                $total_amount += $cost->amount;
                                ?>
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
