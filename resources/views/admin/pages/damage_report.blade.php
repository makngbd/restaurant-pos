@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Damage Report</h1>
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
                        <form class="" action="{{route('search_damage_report')}}" method="post">
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
                                <label>Damage From :</label>
                                <select name="damage_from">
                                    <option value="" <?php if($damage_from == ''){ echo 'selected'; } ?>>All Stock</option>
                                    <option value="Warehouse" <?php if($damage_from == 'Warehouse'){ echo 'selected';} ?>>Warehouse Stock</option>
                                    <option value="Kitchen" <?php if($damage_from == 'Kitchen'){ echo 'selected';} ?>>Kitchen Stock</option>
                                </select>
                            </div>
                            <div style="display: inline-block; transform: translateY(7px)">
                                <button type="submit" class="btn btn-default">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-chain-broken"></i> </span>
                        <h5>Damage Report</h5>
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
@include('admin.partials.footer')