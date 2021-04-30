@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Cost Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">    
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="" action="{{route('search_cost_report')}}" method="post">
                            {{csrf_field()}}
                            <div style="display: inline-block; vertical-align: middle;">
                                <label>Start Date : </label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$start_date}}">
                            </div>
                            <div  style="display: inline-block; vertical-align: middle;">
                                <label>End Date :</label>
                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$end_date}}">
                            </div>
                            <div  style="display: inline-block; vertical-align: middle;">
                                <label>Cost Type :</label>
                                <select name="cost_type">
                                    <option value="">All Types</option>
                                    <option value="Stock" <?php if($cost_type == 'Stock') echo 'selected'; ?>>Stock</option>
                                    <option value="Salary" <?php if($cost_type == 'Salary') echo 'selected'; ?>>Salary</option>
                                    <option value="Equipment" <?php if($cost_type == 'Equipment') echo 'selected'; ?>>Equipment</option>
                                </select>
                            </div>
                            <div style="display: inline-block; transform: translateY(7px)">
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-usd"></i> </span>
                        <h5>Cost Report</h5>
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
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
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
                    <div style="padding: 15px">
                        <h3>Total Cost : {{$total_amount}} /=</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')