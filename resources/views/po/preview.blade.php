@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                <p style="font-size: smaller"><br> Powering Our Customers to be Leaders in their Markets</p>
                                <h4>Cannon Towers, <br>6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email : info@freightwell.com <br> imports@freightwell.com <br>
                                    Web: www.esl-eastafrica.com</h4>
                                <br>
                                <h4>Tax Registration: P051153405J</h4>
                                <h4>Telephone: +254 41 2229784</h4>
                            </address>
                        </div>
                        <div class="pull-right">
                            <address id="client_details">
                                <h3>Purchase Order</h3>
                                <h4>{{ strtoupper($po->po_no) }}</h4>
                                <br>
                                <hr>
                                <br>
                                <h4><b>To</b></h4>
                                <h4>Name : {{ ucwords($po->supplier->Name) }} </h4>
                                <h4>Tax Registration: {{ $po->supplier->Tax_Number }}</h4>
                                {{--                                <h4>Contact Person : {{ mb_strimwidth(ucwords($po->supplier->Contact_Person),0,16,"...") }} </h4>--}}
                                <h4>Telephone : {{ strtoupper($po->supplier->Telephone) }} </h4>
                                <h4>Email :  {{ $po->supplier->EMail }}</h4>
                                <br>
                                <p><b>Date : </b> {{ \Carbon\Carbon::parse($po->created_at)->format('d-M-y') }}</p>
                            </address>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>DESCRIPTION</th>
                                        <th class="text-right">QUANTITY</th>
                                        <th class="text-right">RATE</th>
                                        <th class="text-right">TAX</th>
                                        <th class="text-right">TOTAL AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($po->polines as $line)
                                        <tr id="{{$line->id}}">
                                            <td> {{ ucwords($line->description) }} </td>
                                            <td class="text-right">{{$line->qty}} </td>
                                            <td class="text-right">{{ number_format($line->rate,2) }}</td>
                                            <td class="text-right">{{ number_format($line->tax, 2) }}</td>
                                            <td class="text-right">{{ number_format($line->total_amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <div class="col-sm-12">
                                <h3 id="total_amount">Total (Excl) {{ $po->input_currency }} : {{ number_format(($po->polines->sum('total_amount') - $po->polines->sum('tax')), 2) }}</h3>
                                <br>
                                <h4 style="margin-top: 4px !important; margin-bottom: 4px !important;" id="total_amount">Total Tax {{ $po->input_currency }} : {{ number_format($po->polines->sum('tax'), 2) }}</h4>
                                <br>
                                <h3 id="total_amount"><b>Total (Incl) {{ $po->input_currency }} :</b> {{ number_format(($po->polines->sum('total_amount')), 2) }}</h3>
                            </div>
                            <hr>

                        </div>
                        <div>
                            <address id="client_details text-left">
                                <p>
                                    <br><b>Prepared by :</b> {{ ucwords($po->user->name)  }}</p>
{{--                                <p><b>Checked by :</b> {{ $quotation->checkedBy == null ? '................................' : ucwords($quotation->checkedBy->name )}}</p>--}}
                                <p><b>{{ $po->status == \Esl\helpers\Constants::PO_REQUEST ? 'Waiting Approval' : ($po->status == \Esl\helpers\Constants::PO_APPROVED ? 'Approved by ' : 'Disapproved by ' ) }} :</b> {{ $po->approvedBy == null ? 'WAITING APPROVAL' : ucwords($po->approvedBy->name) }}</p>

                                <p><b>Date :</b> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
                                {{--<h4><b>Signed :</b> ...........................</h4>--}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    {{--<div class="col-sm-12">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-12">--}}
                                        {{--<h4 class="text-left"></h4>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-12">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-12">--}}
                                        {{--<h4 class="text-left">--}}
                                            {{--<b>Account Name: &nbsp;&nbsp;&nbsp;&nbsp;</b> Freightwell Express Limited Nyali, Mombasa <br>--}}
                                            {{--<b>Bank:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> Ecobank Kenya Limited--}}
                                            {{--<br>--}}
                                            {{--<b>Account Detail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> {{ $currency }} Account : {{ $currency == 'USD' ? '0251015023806101' : '0250015023806101'}}--}}
                                            {{--<br>--}}
                                            {{--<b>Swift Adrress: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ECOCKENA--}}
                                        {{--</h4>--}}
                                        {{--<h4 style="text-align: left !important;">PAYMENT TERMS: INVOICE DUE ON DEMAND <br>--}}
                                            {{--ANY OVERDUE AMOUNT WILL ATTRACT 3% INTEREST PER MONTH <br>ALL TRANSACTIONS ARE GOVERNED BY OUR STANDARD TRADING CONDITIONS AVAILABLE UPON REQUEST</h4></div>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-12 pull-right">
                        @if($po->status == \Esl\helpers\Constants::PO_REQUEST )
                            @can('manager')
                                <a href="{{ url('/approve-po/'.$po->id) }}" class="btn btn btn-primary">Approve</a>
                                <a href="{{ url('/disapprove-po/'.$po->id) }}" class="btn btn btn-danger">Disapprove</a>
                            @endcan
                        @endif
                        @if($po->status == \Esl\helpers\Constants::PO_REQUEST )
                                <button class="btn btn-success pull-right" type="button"> <span><i class="fa fa-print"></i> You Cannot Print, Waiting Approval</span> </button>
                        @elseif($po->status == \Esl\helpers\Constants::PO_DISAPPROVED )
                                <button class="btn btn-danger pull-right" type="button"> <span><i class="fa fa-print"></i> Purchase Order Disapproved</span> </button>
                        @else
                                <button id="print" class="btn btn-success pull-right" type="button"> <span><i class="fa fa-print"></i> Print / Download</span> </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection