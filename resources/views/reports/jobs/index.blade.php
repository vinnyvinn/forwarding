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
                        <h4>Jobs Reports</h4>
                        {{--<h4 class="card-title">Leads <a href="{{ route('leads.create') }}" class="btn btn-primary pull-right">Add Lead</a></h4>--}}
                    </div>
                    <div class="card-body">

                        <a href="{{url('export-pdf/'.$from.'/'.$to.'/'.$status.'/xls')}}" class="btn btn-success pull-right" style="margin-left: 5px"><i
                                    class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</a>
                        <a href="{{url('export-pdf/'.$from.'/'.$to.'/'.$status.'/pdf')}}" class="btn btn-info pull-right"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            Export Pdf</a>

                        <div class="table-responsive">
                            <table class="table table-striped tbl-agency">
                                <thead>
                                <tr>
                                     <th>Project Code</th>
                                    <th>Customer</th>
                                    <th>Contact Person</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>BL/SO NO</th>
                                    <th>Created</th>

                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($jobs as $job)
                                    <tr>
                                        <td>{{$job->file_number}}</td>
                                        <td>{{ ucwords($job->customer->Name) }}</td>
                                        <td>{{ ucfirst($job->customer->Contact_Person) }}</td>
                                        <td>{{ $job->customer->Telephone }}</td>
                                        <td>{{$job->quote->type}}</td>
                                        <td>{{$job->bl_number}}</td>
                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d-M-y') }}</td>
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
$('.tbl-agency').dataTable();
    </script>
@endsection
