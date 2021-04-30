@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Kitchen Report</h1>
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
                        <form class="" action="{{route('search_kitchen_report')}}" method="post">
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
                                <label>Select Item :</label>
                                <select name="item_id">
                                    <option value="0">All Items</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}" <?php if($item->id == $item_id) echo 'selected'; ?>>{{$item->item_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div  style="display: inline-block; vertical-align: middle;">
                                <label>Status :</label>
                                <select name="status">
                                    <option value="" <?php if($status == ''){ echo 'selected'; } ?>>All Status</option>
                                    <option value="entry" <?php if($status == 'entry'){ echo 'selected';} ?>>Entry</option>
                                    <option value="return" <?php if($status == 'return'){ echo 'selected';} ?>>Return</option>
                                    <option value="damaged" <?php if($status == 'damaged'){ echo 'selected';} ?>>Damaged</option>
                                </select>
                            </div>
                            <div style="display: inline-block; transform: translateY(7px)">
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-cutlery"></i> </span>
                        <h5>Kitchen Report</h5>
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
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                ?>
                                @foreach($stocks as $key => $stock)
                                <?php
                                $unit = App\Item::find($stock->item_id)->unit;
                                ?>
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$stock->item_name}}</td>
                                    <td style="text-align: center">{{$stock->quantity}} {{$unit}}</td>
                                    <td style="text-align: center">{{$stock->status}}</td>
                                    <td style="text-align: center"><?php echo date('F d, Y', strtotime($stock->date)) ?></td>
                                </tr>
                                <?php
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
@include('admin.partials.footer')