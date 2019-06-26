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
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10">
                <i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Leads Reports</h4>
                        {{--<h4 class="card-title">Leads <a href="{{ route('leads.create') }}" class="btn btn-primary pull-right">Add Lead</a></h4>--}}
                    </div>
                    <div class="card-body">

                        <a href="{{url('export-lead/'.$from.'/'.$to.'/xls')}}" class="btn btn-success pull-right" style="margin-left: 5px"><i
                                    class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</a>
                        <a href="{{url('export-lead/'.$from.'/'.$to.'/pdf')}}" class="btn btn-info pull-right"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            Export Pdf</a>

                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Currency</th>
                                    <th>Created</th>

                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>{{ ucwords($lead->name) }}</td>
                                        <td>{{ ucfirst($lead->contact_person) }}</td>
                                        <td>{{ $lead->phone }}</td>
                                        <td>{{$lead->email}}</td>
                                        <td>{{$lead->currency}}</td>
                                        <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-M-y') }}</td>
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
@endsection
@section('scripts')
    <script>

    </script>
@endsection
