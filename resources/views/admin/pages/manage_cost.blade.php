@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Costs</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('add_cost')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New Cost</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-list-alt"></i> </span>
                        <h5>Costs ({{count($costs)}})</h5>
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
                    @isset($success)
                    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Success!</h4>
                        {{$success}}
                    </div>
                    @endisset
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Suppliers</th>
                                    <th>Particulars</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_amount = 0;
                                ?>
                                @foreach($costs as $key => $cost)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$cost->supplier}}</td>
                                    <td>{{$cost->particular}}</td>
                                    <td style="text-align: right">{{$cost->amount}} /=</td>
                                    <td>{{$cost->date}}</td>
                                    <td style="text-align: center">  
                                        <a class="tip" href="{{route('delete_cost', ['id'=> $cost->id])}}" data-original-title="Delete" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-remove"></i></a> 
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
                        <h3>Total Cost : {{$total_amount}} /=</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')