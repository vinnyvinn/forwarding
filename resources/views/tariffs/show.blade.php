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
                        <h4 class="card-title">{{ ucwords($lead->name) }}</h4>
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
                            <a href="{{ url('/customer-request/'.$lead->id.'/'.\Esl\helpers\Constants::LEAD_CUSTOMER) }}" class="btn btn-primary">Accept Request</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

