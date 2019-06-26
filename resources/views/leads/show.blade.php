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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Lead {{ ucwords($lead->name) }}</h4>
                        <table class="table table-borded">
                            <tr>
                                <td><strong>Name : </strong> {{ ucwords($lead->name) }}</td>
                                <td><strong>Contact Person : </strong> {{ ucwords($lead->contact_person) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address : </strong> {{ ucwords($lead->address) }}</td>
                                <td><strong>Phone : </strong> {{ $lead->phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telephone : </strong> {{ $lead->telephone }}</td>
                                <td><strong>Location : </strong> {{ $lead->location }}</td>
                            </tr>
                        </table>

                        <div class="col-sm-8">
                            <a href="{{ url('/customer-request/'.$lead->id.'/'.\Esl\helpers\Constants::LEAD_CUSTOMER) }}" class="btn btn-primary">Generate Quotation</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3>Lead Quotations</h3>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Vessel</th>
                                    <th>Quotation Status</th>
                                    <th>Created On</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($quotations->quotation as $quotation)
                                        <tr>
                                            <td>ESL00{{ ucwords($quotation->id) }}</td>
                                            <td>{{ ucfirst($quotation->vessel->name) }}</td>
                                            <td>{{ ucfirst($quotation->status) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</td>
                                            <td class="text-nowrap">
                                                    <a href=" {{ url('/quotation/'. $quotation->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
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

