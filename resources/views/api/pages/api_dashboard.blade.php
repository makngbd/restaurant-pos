<!DOCTYPE html>
<html lang="en">

<head>
    <title>Royal Restaurant</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{asset('admin/img/favicon.ico')}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-style.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-media.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-wysihtml5.css')}}" />
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="{{route('index')}}"></a></h1>
    </div>
    <?php
    $category_count = App\Category::where('deletation_status', false)->count();
    $p_product_count = App\Product::where('deletation_status', false)->where('publication_status', true)->count();
    $u_product_count = App\Product::where('deletation_status', false)->where('publication_status', false)->count();
    $order_count = App\Order::count();
    $total_sales = App\Order::select(DB::raw('SUM(grand_total) as amount'))->first()->amount;
    $total_costs = App\Cost::select(DB::raw('SUM(amount) as amount'))->first()->amount;
    $balance = $total_sales - $total_costs;
    ?>
    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <h1>Dashboard</h1>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="quick-actions_homepage">
                        <ul class="quick-actions">
                            <li class="bg_lb"> <a style="height: 100px; min-width: 150px;">
                                    <h4> <i class="fa fa-list-alt"></i> Categories</h4>
                                    <h4>{{$category_count}}</h4> Total categories
                                </a> </li>
                            <li class="bg_ls"> <a style="height: 100px; min-width: 150px;">
                                    <h4> <i class="fa fa-gift"></i> Products</h4>
                                    <h4>{{$p_product_count}}</h4> Published products
                                </a> </li>
                            <li class="bg_lg"> <a style="height: 100px; min-width: 150px;">
                                    <h4><i class="fa fa-first-order"></i> Order</h4>
                                    <h4>{{$order_count}}</h4> Total orders
                                </a> </li>
                            <li class="bg_ly"> <a style="height: 100px; min-width: 150px;">
                                    <h4>Total Sales</h4>
                                    <h4>{{$total_sales}}</h4> BDT
                                </a> </li>
                            <li class="bg_lb"> <a style="height: 100px; min-width: 150px;">
                                    <h4>Total Costs</h4>
                                    <h4>{{$total_costs}}</h4> BDT
                                </a> </li>
                            <li class="bg_lo"> <a style="height: 100px; min-width: 150px;">
                                    <h4> Balance</h4>
                                    <h4>{{$balance}}</h4> BDT
                                </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="raw-fluid">
                <div class="span12">
                    <div id="pie_chart" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-content">
                            <form class="" action="{{route('search_sales_cost')}}" method="post">
                                {{csrf_field()}}
                                <div>
                                    <label>Start Date : </label>
                                    <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="{{$start_date}}" style="width: 95%;">
                                </div>
                                <div>
                                    <label>End Date :</label>
                                    <input type="date" class="form-control" placeholder="End Date" name="end_date" value="{{$end_date}}" style="width: 95%;">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-default">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                            <h5>Sales and Cost Chart</h5>
                        </div>
                        <div class="widget-content" style="overflow-x: auto;">
                            <div style="min-width: 700px;">
                                <div class="chart"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);
    ?>
    <!--end-main-container-part-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <?php
    $output_sales = "";
    for ($i = $start_date, $j = 0; $i <= $end_date; $i = strtotime("+1 day", $i)) {
        $data_sales = 0;
        if (isset($sales[$j])) {
            $date = strtotime($sales[$j]->date);
            if ($i == $date) {
                $data_sales = $sales[$j]->amount;
                $j++;
            } else {
                $data_sales = 0;
            }
        }
        $date = date("d", $i);
        $output_sales .= '[' . $date . ',' . $data_sales . '],';
    }
    $output_costs = "";
    $j = 0;
    for ($i = $start_date; $i <= $end_date; $i = strtotime("+1 day", $i)) {
        $data_cost = 0;
        if (isset($costs[$j])) {
            $date = strtotime($costs[$j]->date);
            if ($i == $date) {
                $data_cost = $costs[$j]->amount;
                $j++;
            } else {
                $data_cost = 0;
            }
        }
        $date = date("d", $i);
        $output_costs .= '[' . $date . ',' . $data_cost . '],';
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            // === Prepare the chart data ===/
            var sales = [
                <?php echo $output_sales ?>
            ];
            var costs = [
                <?php echo $output_costs; ?>
            ];
            var plot = $.plot($(".chart"),
                [{
                    data: sales,
                    label: "Sales",
                    color: "#488C13"
                }, {
                    data: costs,
                    label: "Costs",
                    color: "#97080E"
                }], {
                    series: {
                        lines: {
                            show: true
                        },
                        points: {
                            show: true
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    },
                    yaxis: {
                        min: 0,
                        max: {
                            {
                                $peak_value
                            }
                        }
                    }
                });
            // === Point hover in chart === //
            var previousPoint = null;
            $(".chart").bind("plothover", function(event, pos, item) {

                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;
                        $('#tooltip').fadeOut(200, function() {
                            $(this).remove();
                        });
                        var x = item.datapoint[0],
                            y = item.datapoint[1].toFixed(2);
                        maruti.flot_tooltip(item.pageX, item.pageY, item.series.label + " of day " + x + " = " + y + " Tk");
                    }

                } else {
                    $('#tooltip').fadeOut(200, function() {
                        $(this).remove();
                    });
                    previousPoint = null;
                }
            });
            var data = [];
            data[0] = {
                label: "Burger",
                data: 40
            }
            data[1] = {
                label: "Pizza",
                data: 60
            }

            var pie = $.plot($(".pie"), data, {
                series: {
                    pie: {
                        show: true,
                        radius: 3 / 4,
                        label: {
                            show: true,
                            radius: 3 / 4,
                            formatter: function(label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                            },
                            background: {
                                opacity: 0.5,
                                color: '#000'
                            }
                        },
                        innerRadius: 0.2
                    },
                    legend: {
                        show: false
                    }
                }
            });
            var d1 = [];
            for (var i = 0; i <= 10; i += 1)
                d1.push([i, parseInt(Math.random() * 30)]);
            var data = new Array();
            data.push({
                data: d1,
                bars: {
                    show: true,
                    barWidth: 0.4,
                    order: 1,
                }
            });
            //Display graph
            var bar = $.plot($(".bars"), data, {
                legend: true
            });
        });
        maruti = {
            // === Tooltip for flot charts === //
            flot_tooltip: function(x, y, contents) {

                $('<div id="tooltip">' + contents + '</div>').css({
                    top: y + 5,
                    left: x + 5
                }).appendTo("body").fadeIn(200);
            }
        }
    </script>
    <?php
    $sql = "SELECT id, category_name, COALESCE(cat_sale.amount, 0) as amount 
                    FROM categories cat
                    LEFT JOIN(
                        SELECT SUM((sales.amount-sales.discount)) as amount, pd.product_category FROM products pd
                        left join(
                            SELECT product_id, sum(amount) as amount, sum(discount) as discount FROM `sales` group BY product_id
                        ) as sales ON pd.id=sales.product_id
                        GROUP by pd.product_category
                    ) as cat_sale ON (cat.id=cat_sale.product_category)";
    $categories = DB::select($sql);
    $_data = "[";
    $_data_product = "[";
    foreach ($categories as $cat) {

        $sql2 = "SELECT pd.id, pd.product_name, (COALESCE(sales.amount,0)-COALESCE(sales.discount,0)) as amount FROM products pd
                    left join(
                            SELECT product_id, sum(amount) as amount, sum(discount) as discount FROM `sales` group BY product_id
                    ) as sales ON pd.id=sales.product_id
                    WHERE pd.product_category=" . $cat->id;

        $cat_products = DB::select($sql2);

        $_data_product .= "{name: \"" . $cat->category_name . "\",";
        $_data_product .= "id: \"" . $cat->category_name . "\",";

        $_data_product .= "data: [";
        $k = 0;
        foreach ($cat_products as $pd) {
            if ($k > 0)
                $_data_product .= ",";
            $_data_product .= "[\"" . $pd->product_name . "\", " . $pd->amount . "]";
            $k++;
        }
        $_data_product .= "]},";

        $_data .= "{";
        $_data .= "name: '" . $cat->category_name . "',";
        $_data .= "y: " . $cat->amount . ",";
        $_data .= "drilldown: '" . $cat->category_name . "'";
        $_data .= "},";
    }
    $_data .= "]";
    $_data_product .= "]";
    ?>
    <script>
        Highcharts.chart('pie_chart', {
            chart: {
                backgroundColor: '',
                type: 'pie'
            },
            title: {
                text: 'Category wise Products Sales Amount'
            },
            subtitle: {
                text: ''
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y:.1f} BDT'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} BDT</b> of total<br/>'
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: <?php echo $_data; ?>
            }],
            drilldown: {
                series: <?php echo $_data_product; ?>
            }
        });
    </script>

    <!--end-main-container-part-->

    <!--Footer-part-->

    <div class="row-fluid">
        <div id="footer" class="span12">
            <p>2017 &copy; Royal Restaurant.</p>
            <p>Developed by <a href="http://makngbd.com" target="_blank">Arif Khan</a> </p>
        </div>
    </div>

    <!--end-Footer-part-->
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admin/js/masked.js')}}"></script>
    <script src="{{asset('admin/js/jquery.uniform.js')}}"></script>
    <script src="{{asset('admin/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.js')}}"></script>
    <script src="{{asset('admin/js/matrix.form_common.js')}}"></script>
    <script src="{{asset('admin/js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('admin/js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-wysihtml5.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.charts.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.dashboard.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>

    <script>
        $('.textarea_editor').wysihtml5();
    </script>
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }

        $('.textarea_editor').wysihtml5();
    </script>
</body>

</html>