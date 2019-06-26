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

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="card-title text-white">Jobs</h4>
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive">
                            <table id="dtforall" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Project code</th>
                                    <th>Ref No.</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>BL/SO NO</th>
                                    <th>Created</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    @if($dm->status ==0)
                                        <tr>

                                            <td>{{ $dm->file_number }}
                                            </td>
                                            <td>{{$dm->code_name}}</td>
                                            <td>
                                                <a href="{{ url('dms/edit/'. $dm->id) }}">{{ ucwords($dm->customer ? $dm->customer->Name :'') }}</a>

                                            </td>


                                            <td>{{ ucwords($dm->customer? $dm->customer->Contact_Person :'') }}</td>
                                            <td>{{ $dm->customer ? $dm->customer->Telephone :''}}</td>
                                            <td>{{ ucwords($dm->quote ? $dm->quote->type :'') }}</td>
                                            <td>{{ $dm->bl_number }}</td>
                                            <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>
                                            <td class="text-right">

                                                    <a href=" {{ url('dms/edit/'. $dm->id) }}"
                                                       class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                            </td>

                                        </tr>
                                    @endif
                                        @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h4 class="card-title text-white">Completed Jobs</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="dtforall2" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Project code</th>
                                    <th>Ref No.</th>
                                    <th>BL/SO NO</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>Created</th>

                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    @if($dm->status ==1)


                                        <tr>
                                            <td>{{ $dm->file_number }}
                                            </td>
                                            <td>{{$dm->code_name}}</td>

                                            <td>{{ $dm->bl_number }}</td>
                                            <td>
                                                @if($dm->customer)
                                                    <a href="{{ url('/customer-dsr/'.$dm->customer->DCLink) }}">{{ ucwords($dm->customer ? $dm->customer->Name :'') }}</a>
                                              @else
                                                    <a href="#">{{ ucwords($dm->customer ? $dm->customer->Name :'') }}</a>
                                                @endif
                                            </td>
                                            <td>{{ ucwords($dm->customer ? $dm->customer->Contact_Person:'') }}</td>
                                            <td>{{ $dm->customer ? $dm->customer->Telephone :'' }}</td>
                                             <td>{{ ucwords($dm->quote->type ) }}</td>
                                             <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>

                                        </tr>
                                    @endif
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
