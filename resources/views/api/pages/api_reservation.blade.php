@include('api.partials.header')

<div id="content">
    <div id="content-header">
        <h1>Costs Report</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="fa fa-exchange"></i></span>
                        <h5>Costs Report</h5>
                    </div>
                    <div class="widget-content nopadding table-responsive">
                        <table class="table table-bordered data-table" style="min-width: 500px;">
                             <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Guest</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $key => $reservation)
                                <tr>
                                    <td style="text-align: center">{{$key+1}}</td>
                                    <td>{{$reservation->name}}</td>
                                    <td>{{$reservation->email}}</td>
                                    <td style="text-align: center">{{$reservation->phone}}</td>
                                    <td style="text-align: center">{{$reservation->guest}}</td>
                                    <td style="text-align: center">{{$reservation->date}}</td>
                                    <td style="text-align: center">{{$reservation->time}}</td>
                                </tr>
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
