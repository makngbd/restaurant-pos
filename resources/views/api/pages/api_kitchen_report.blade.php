@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Kitchen Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form" action="{{route('api_search_kitchen_report')}}" method="post">
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
                                <label>Select Item :</label>
                                <select name="item_id">
                                    <option value="0">All Items</option>
                                    @foreach($items as $item)
                                    <option value="{{$item->id}}" <?php if($item->id == $item_id) echo 'selected'; ?>>{{$item->item_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status :</label>
                                <select name="status">
                                    <option value="" <?php if($status == ''){ echo 'selected'; } ?>>All Status</option>
                                    <option value="entry" <?php if($status == 'entry'){ echo 'selected';} ?>>Entry</option>
                                    <option value="return" <?php if($status == 'return'){ echo 'selected';} ?>>Return</option>
                                    <option value="damaged" <?php if($status == 'damaged'){ echo 'selected';} ?>>Damaged</option>
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
                        <h5>Kitchen Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
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

@include('api.partials.footer')
