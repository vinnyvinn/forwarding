@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-8"><h2>{{ count(\App\Lead::where('status',0)->get()) }} <i class="ti-angle-down font-14 text-danger"></i></h2>
                                <h6>Total Leads</h6></div>
                            <div class="col-4 align-self-center text-right  p-l-0">
                                <div id="sparklinedash3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-8"><h2 class="">{{ count(\App\Quotation::all()) }} <i class="ti-angle-up font-14 text-success"></i></h2>
                                <h6>Total PDA</h6></div>
                            <div class="col-4 align-self-center text-right p-l-0">
                                <div id="sparklinedash"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-8"><h2>$ {{ number_format(\App\QuotationService::all()->sum('total') )}} <i class="ti-angle-up font-14 text-success"></i></h2>
                                <h6>Services Projection </h6></div>
                            <div class="col-4 align-self-center text-right p-l-0">
                                <div id="sparklinedash2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-8"><h2>{{ \App\Cargo::all()->sum('weight') }} MT <i class="ti-angle-up font-14 text-success"></i></h2>
                                <h6>Total Cargo Weight</h6></div>
                            <div class="col-4 align-self-center text-right p-l-0">
                                <div id="sparklinedash4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Leads</h4>
                    </div>
                    <div class="comment-widgets m-b-20">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="customers">
                                        @foreach($leads as $lead)
                                            @if($lead->status == 0)
                                                <tr>
                                                    <td>{{ ucwords($lead->name) }}</td>
                                                    <td>{{ ucfirst($lead->contact_person) }}</td>
                                                    <td>{{ $lead->phone }}</td>
                                                    <td>{{ $lead->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-M-y') }}</td>
                                                    <td class="text-nowrap">
                                                        <a href=" {{ route('leads.show', $lead->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="footable pagination">
                                        {{ $leads->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Notification</h4>
                        <ul class="feeds">
                            @foreach($v_notifications as $notification)
                                <li>
                                    <div class="bg-light-info"><i class="fa fa-bell-o"></i></div> You have 4 pending tasks.
                                    <a href="{{ url('/notifications/'.$notification->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> <span class="text-muted"> 1 mins</span>
                                </li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
