@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Equipment Costs</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('add_equipment_cost')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add Equipment Cost</a>
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
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-cogs"></i> </span>
                        <h5>Equipment Costs ({{count($costs)}} items)</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Equipment Name</th>
                                    <th>Description</th>
                                    <th>Amount (Tk)</th>
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
                                    <td>{{$cost->equipment_name}}</td>
                                    <td>{{$cost->description}}</td>
                                    <td style="text-align: right">{{$cost->amount}}</td>
                                    <td style="text-align: center">  
                                        <a class="tip" href="{{route('delete_equipment_cost', ['id'=> $cost->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-remove"></i></a> 
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
                        <h3>Total Equipment Cost : {{$total_amount}} /=</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')