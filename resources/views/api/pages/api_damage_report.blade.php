@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Damage Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content">
                        <form class="form" action="{{route('api_search_damage_report')}}" method="post">
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
                                <label>Damage From :</label>
                                <select name="damage_from">
                                    <option value="" <?php if($damage_from == ''){ echo 'selected'; } ?>>All Stock</option>
                                    <option value="Warehouse" <?php if($damage_from == 'Warehouse'){ echo 'selected';} ?>>Warehouse Stock</option>
                                    <option value="Kitchen" <?php if($damage_from == 'Kitchen'){ echo 'selected';} ?>>Kitchen Stock</option>
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
                        <h5>Damage Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                             <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Damage From</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                ?>
                                @foreach($damage_items as $key => $item)
                                <?php
                                $unit = App\Item::find($item->item_id)->unit;
                                ?>
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td style="text-align: center">{{$item->quantity}} {{$unit}}</td>
                                    <td style="text-align: center">{{$item->damage_from}}</td>
                                    <td style="text-align: center"><?php echo date('F d, Y', strtotime($item->date)) ?></td>
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
