@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Kitchen Stock</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="text-left">
                    <a href="{{route('add_kitchen_stock')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New Item</a>
                </div>
            </div>
            <div class="span6">
                <div class="text-right">
                    <a href="#return_item" data-toggle="modal" class="btn btn-primary"><i class="fa fa-undo"></i> Return Item</a>
                </div>
            </div>
            <div id="return_item" class="modal hide">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3><i class="fa fa-undo"></i> Return Item</h3>
                </div>
                <div class="modal-body">
                    <form action="{{route('return_item')}}" method="post" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="control-group">
                            <label class="control-label">Select Item</label>
                            <div class="controls">
                                <select name="item_id" id="item" class="span6" required="">
                                    @foreach($k_stocks as $k_stock)
                                    <option value="{{$k_stock->item_id}}">{{$k_stock->item_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach($k_stocks as $k_stock)
                        <?php
                        $item = App\Item::find($k_stock->item_id);
                        ?>
                        <input type="hidden" id="unit{{$item->id}}" value="{{$item->unit}}">
                        @endforeach
                        <div class="control-group">
                            <label class="control-label">Quantity :</label>
                            <div class="controls">
                                <div class="input-append" style="width:100%;">
                                    <input type="number" step="0.001" placeholder="Quantity" class="span6" name="quantity" required="" />
                                    <span class="add-on" id="unit"></span>
                                </div>
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn btn-default"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-content nopadding">
                        <form action="{{route('add_item_to_kitchen')}}" method="post" class="form-horizontal" id="myform">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label"><i class="fa fa-search"></i> <b>Search Item :</b></label>
                                <div class="controls">
                                    <input type="text" placeholder="Item Name" class="span9 item_name" autofocus="" />
                                    <input type="number" step="0.001" placeholder="Qty" id="quantity" name="quantity" class="span1 enterKey" max="10000" />
                                    <select name="unit" class="span1 unit" required="">
                                        <option value="kg">kg</option>
                                        <option value="gm">gm</option>
                                        <option value="litre">litre</option>
                                        <option value="ml">ml</option>
                                        <option value="piece">piece</option>
                                        <option value="pack">pack</option>
                                    </select>
                                    <input type="hidden" id="item_id" name="item_id" />
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> </button>
                                </div>
                                <label class="control-label">Available Stock :</label>
                                <div class="controls">
                                    <input type="text" class="span9 item_name" disabled="" style="cursor: auto" />
                                    <input type="number" class="span1" id="stock_qty" disabled="" style="cursor: auto" />
                                    <input type="text" class="span1 unit" disabled="" style="cursor: auto" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(count($errors) > 0)
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    @foreach($errors->all() as $error)
                    <p>
                        <strong>Error!</strong> {{ $error }}
                    </p>
                    @endforeach
                </div>
                @endif
                <div class="flash-message" style="margin-top: 20px">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                    @endforeach
                </div> <!-- end .flash-message -->
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-cutlery"></i> </span>
                        <h5>Kitchen Stock ({{count($k_stocks)}} items)</h5>
                    </div>

                    <div class="widget-content nopadding table-responsive">
                        <form action="{{ route('process_order') }}" method="post">
                            {{csrf_field()}}
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ?>
                                    @foreach($k_stocks as $key => $k_stock)
                                    <?php
                                    $unit = App\Item::find($k_stock->item_id)->unit;
                                    ?>
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$k_stock->item_name}}</td>
                                        <td>{{$k_stock->quantity}} {{$unit}}</td>
                                    </tr>
                                    <?php
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('admin/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('admin/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    //$(document).ready(function () {
    $('.item_name').autocomplete({
        source: "{{route('search_item')}}",
        minlength: 1,
        autoFocus: true,
        select: function(e, ui) {
            $('#item_id').val(ui.item.id);
            $('.item_name').val(ui.item.value);
            $('#stock_qty').val(ui.item.quantity);
            $('.unit').val(ui.item.unit);
        }
    });
    $('.enterKey').keypress(function(e) {
        if (e.which === 13) {
            $('#myform').submit();
        }
    });
    //});
</script>
<script>
    $(window).load(function() {
        var valueSelected = $('#item').val();
        var unit = $('#unit' + valueSelected).val();
        $('#unit').text(unit);
    })
    $('#item').on('change', function(e) {
        var valueSelected = this.value;
        var unit = $('#unit' + valueSelected).val();
        $('#unit').text(unit);
    });
</script>
@include('admin.partials.footer')