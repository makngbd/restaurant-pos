@extends('admin.layouts.admin_master')
@section('admin_main_content')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Sync Data</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-user"></i> </span>
                        <h5>Sync Data</h5>
                    </div>
                    <?php
                    $success_upload = Session::get('success_upload');
                    if ($success_upload) {
                        ?>
                    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$success_upload}}</h4>
                    </div>
                    <?php
                        Session::put('success_upload', '');
                    }
                    ?>
                    <?php
                    $success_download = Session::get('success_download');
                    if ($success_download) {
                        ?>
                    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$success_download}}</h4>
                    </div>
                    <?php
                        Session::put('success_download', '');
                    }
                    ?>
                    
                    <?php
                    $error_upload = Session::get('error_upload');
                    if ($error_upload) {
                        ?>
                    <div class="alert alert-danger alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$error_upload}}</h4>
                    </div>
                    <?php
                        Session::put('error_upload', '');
                    }
                    ?>
                    <?php
                    $error_download = Session::get('error_download');
                    if ($error_download) {
                        ?>
                    <div class="alert alert-danger alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$error_download}}</h4>
                    </div>
                    <?php
                        Session::put('error_download', '');
                    }
                    ?>
                    <?php
                    $error_reachable = Session::get('error_reachable');
                    if ($error_reachable) {
                        ?>
                    <div class="alert alert-danger alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">{{$error_reachable}}</h4>
                    </div>
                    <?php
                        Session::put('error_reachable', '');
                    }
                    ?>
                    <div class="widget-content nopadding">
                        <form action="{{route('sync_json_data')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-actions" style="text-align: center">
                                <button type="submit" class="btn btn-success btn-large"><i class="fa fa-refresh"></i> Start Sync</button>
                            </div> 
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection