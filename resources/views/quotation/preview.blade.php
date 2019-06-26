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
            <div class="card card-body printableArea">
                <h3 class="text-center">{{ $quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED ? 'FDA' : 'PROFORMA DISBURSEMENT ACCOUNT' }}</h3>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                <h4>Express Shipping & Logistics (EA) Limited</h4>
                                <h4>Cannon Towers <br>
                                    6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email :agency@esl-eastafrica.com or ops@esl-eastafrica.com <br>
                                    Web: www.esl-eastafrica.com</h4>
                                <h4> &nbsp;<b>TO : {{ ucwords($quotation->lead->name) }}</b></h4>
                                <h4 class="m-l-5"><strong>Contact Person : </strong> {{ ucwords($quotation->lead->contact_person) }}
                                    <br/> <strong>Tel/Email : </strong> {{ $quotation->lead->telephone }} {{ $quotation->lead->email }}
                                    <br/> <strong>Phone : </strong> {{ $quotation->lead->phone }}
                                </h4>
                                <br>
                                @foreach($quotation->cargos as $cargo)
                                    <h4>&nbsp;<b>CARGO  </b> {{ ucwords($cargo->name) }}</h4>
                                    <h4>&nbsp;<b>CARGO  QUANTITY </b> {{ $cargo->weight }} MT</h4>
                                @endforeach
                                <h4>&nbsp;<b>DISCHARGE RATE</b>  {{ $quotation->discharge_rate }}  MT / WWD</h4>
                                <h4>&nbsp;<b>PORT STAY  </b> {{ ceil(($quotation->vessel->grt)/$quotation->discharge_rate) }} Days</h4>

                            </address>
                        </div>
                        <div class="pull-right">
                            <div class="row">
                                <div class="form-group">
                                    <h1 style="color: {{ $quotation->status == 'pending' ? 'red' : ($quotation->status == 'accepted' || $quotation->status == 'converted' ? 'green' : 'gray') }}">{{ strtoupper($quotation->status == 'pending' ? 'DRAFT' : $quotation->status) }}</h1>
                                    <h3>Tax Registration: 0121303W</h3>
                                    <h3>Telephone: +254 41 2229784</h3>
                                    {{--<label><h4><b>Currency</b></h4></label>--}}
                                    {{--<select class="form-control" name="currency" id="currency">--}}
                                        {{--<option value="">Select Currency</option>--}}
                                        {{--<option value="usd">USD</option>--}}
                                        {{--<option value="kes">KES</option>--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                            <address>
                                {{--<h4><b>Job No</b> ESL002634</h4>--}}
                                <h4><b>Voyage No</b> {{ strtoupper($quotation->voyage->voyage_no) }}</h4>
                                <h4>Currency : US Dollar</h4>
                                <h4 id="vessel_name"><b>VESSEL</b> {{ strtoupper($quotation->vessel->name )}}</h4>
                                <h4 id="grt"><b>GRT</b> {{ $quotation->vessel->grt }} GT</h4>
                                <h4 id="loa"><b>LOA</b> {{ $quotation->vessel->loa }} M</h4>
                                <h4 id="port"><b>PORT</b> {{ strtoupper($quotation->vessel->port) }}</h4>
                                <br>
                                <p><b>Date : </b> {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</p>
                            </address>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">GRT/LOA</th>
                                    <th class="text-right">RATE</th>
                                    <th class="text-right">UNITS</th>
                                    <th class="text-right">Tax</th>
                                    <th class="text-right">Total (Incl)</th>
                                </tr>
                                </thead>
                                <tbody id="q_service">
                                @foreach($quotation->services as $service)
                                    <tr>
                                        <td>{{ ucwords($service->description) }}</td>
                                        <td class="text-right">{{ $service->grt_loa }}</td>
                                        <td class="text-right">{{ $service->rate }}</td>
                                        <td class="text-right">{{ $service->units }}</td>
                                        <td class="text-right">{{ $service->tax }}</td>
                                        <td class="text-right">{{ number_format($service->total) }}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <p id="sub_ex">Total (Excl) $ : {{ number_format($quotation->services->sum('total')) }}</p>
                            <p id="total_tax">Tax $ : {{ number_format($quotation->services->sum('total_tax')) }} </p>
                            <p id="sub_in">Total (Incl) $ : {{ number_format($quotation->services->sum('total')) }} </p>
                            <hr>
                            <h3 id="total_amount"><b>Total (Incl) $ :</b> {{ number_format($quotation->services->sum('total')) }}</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-sm-12">
                            <h3>Remarks</h3>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Remarks</th>
                                    <th class="text-right">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotation->remarks->sortByDesc('created_at') as $remark)
                                    <tr>
                                        <td>{{ ucwords($remark->user->name) }}</td>
                                        <td>{{ ucfirst($remark->remark) }}</td>
                                        <td class="text-right">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-y') }}</td>
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