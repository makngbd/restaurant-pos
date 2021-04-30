@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Salary Costs</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('add_salary_cost')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add Salary Cost</a>
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
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
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-money"></i> </span>
                        <h5>Salary Costs ({{count($costs)}} items)</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Amount (Tk)</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_amount = 0;
                                ?>
                                @foreach($costs as $key => $cost)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$cost->employee_name}}</td>
                                    <td style="text-align: center">{{$cost->month}}</td>
                                    <td style="text-align: right">{{$cost->amount}}</td>
                                    <td>{{$cost->remark}}</td>
                                    <td style="text-align: center">  
                                        <a class="tip" href="{{route('delete_salary_cost', ['id'=> $cost->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-remove"></i></a> 
                                    </td>
                                </tr>
                                <?php
                                $total_amount += $cost->amount;
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 15px">
                        <h3>Total Salary Cost : {{$total_amount}} /=</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')