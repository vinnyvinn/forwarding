@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
            </ol>
        </div>
        
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ ucwords($contract->company_name) }}'s Contract</h4>
                        <table class="table table-borded">
                            <tr>
                                <td><strong>Company Name : </strong> {{ ucwords($contract->company_name) }}</td>
                                <td><strong>Contact : </strong> {{ ucwords($contract->contact) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Contract Type : </strong> {{ $contract->contract_type == 'open' ? 'Open' : ($contract->contract_type == 'per_km' ? 'Per Kilo Meter' : 'Per Tonne')  }}</td>
                                <td><strong>Charge : </strong> {{ $contract->contract_type == 'open' ? ' ' : $contract->value }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Contract Body : </strong> <br>
                                    {{ ucfirst($contract->body) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Remarks : </strong> <br>
                                    {{ ucfirst($contract->remarks) }}</td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

