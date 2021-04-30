@extends('admin.layouts.admin_master')
@section('admin_main_content')
<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Add Salary Cost</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <a href="{{route('manage_salary_cost')}}" class="btn btn-info"><i class="fa fa-money"></i> Salary Cost</a>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-money"></i> </span>
                        <h5>Add Salary Cost</h5>
                    </div>
                    <div class="flash-message">
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
                    <div class="widget-content nopadding">
                        <form action="{{route('save_salary_cost')}}" method="post" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Employee Name :</label>
                                <div class="controls">
                                    <input type="text" placeholder="Employee Name" name="employee_name" class="span6" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Month of Salary :</label>
                                <div class="controls">
                                    <input type="month" name="month" class="span6" required="" value="<?php echo date('Y-m', strtotime('-1 month')) ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Salary Amount :</label>
                                <div class="controls">
                                    <input type="number" placeholder="Amount" name="amount" class="span6" min="0" required=""/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Remarks :</label>
                                <div class="controls">
                                    <input type="test" name="remark" class="span6"/>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection