@include('admin.partials.header')
@include('admin.partials.admin_top_menu')
@include('admin.partials.admin_sidebar')

<div id="content">
    <div id="content-header">
        @include('admin.partials.breadcrumb')
        <h1>Company Profile</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="fa fa-list-alt"></i> </span>
                        <h5>Company Profile</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{$company_profile->company_name}}</td>
                                </tr>
                                <tr>
                                    <th>Company Address</th>
                                    <td>{{$company_profile->company_address}}</td>
                                </tr>
                                <tr>
                                    <th>Company Email</th>
                                    <td>{{$company_profile->company_email}}</td>
                                </tr>
                                <tr>
                                    <th>Company Phone</th>
                                    <td>{{$company_profile->company_phone}}</td>
                                </tr>
                                <tr>
                                    <th>Company VAT Reg. No.</th>
                                    <td>{{$company_profile->company_vat_reg_no}}</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{route('edit_company_profile')}}" class="btn btn-success"><i class="fa fa-edit"></i> Change Company Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')