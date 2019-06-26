@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboardp</li>
            </ol>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">

            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_PENDING)
                <div class="card card-body printableArea">
                    <h3 class="text-center">{{ $quotation->status }}</h3>
                    <br>
                    <div class="row">
                        @include('partials.quotation.invoice-head')
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                @include('partials.quotation.add-service')
                                <div class="row">
                                    <div class="col-sm-12"><div class="col-sm-4 pull-right">
                                            <div class="pull-right">
                                                <h3 id="total_amount">Total USD : 0</h3>
                                                <button onclick="storeServiceData()" class="btn btn-primary pull-right">Update Quotation</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><br>
                                        <br></div>
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-responsive table-hover">
                                            <thead>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th class="text-right">QUANTITY</th>
                                                <th class="text-right">UNIT PRICE</th>
                                                <th class="text-right">TAX</th>
                                                <th class="text-right">TOTAL AMOUNT</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotation->services as $service)
                                                <tr id="{{$service->id}}">
                                                    <td> {{ ucwords($service->name) }} </td>
                                                    <td class="text-right">{{$service->total_units}} </td>
                                                    <td class="text-right">{{ number_format($service->selling_price, 2) }}</td>
                                                    <td class="text-right">{{ number_format($service->tax, 2) }}</td>
                                                    <td class="text-right">{{ number_format($service->total, 2) }}</td>
                                                    <td class="text-right">
                                                        <button data-toggle="modal" data-target=".bs-example-modal-lg{{$service->id}}" class="btn btn-xs btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <div class="modal fade bs-example-modal-lg{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myLargeModalLabel">Edit Service</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <form style="text-align: left !important;" id="update_service{{$service->id}}" onsubmit="event.preventDefault(); submitForm(this, '/update-service');" action="" method="post">
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label for="name text-left">Description</label>
                                                                                            <input type="text" value="{{ ucwords($service->name) }}" readonly required id="name" name="name" class="form-control" placeholder="Description">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="rate">Unit Price </label>
                                                                                            <input type="text" required id="{{$service->id}}rate" value="{{ $service->selling_price }}" name="rate" class="form-control" placeholder="Unit Price">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="total_units">Quantity</label>
                                                                                            <input type="text" required id="qt{{$service->id}}" onkeyup="updateServiceTotal(this,'{{$service->rate}}')" value="" name="total_units" class="form-control" placeholder="Quantity">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="tax{{$service->id}}">Select Tax</label>
                                                                                            <select style="width: 100% !important;" name="taxs" onchange="onTaxChange('tax{{$service->id}}')" required id="tax{{$service->id}}" class="form-control select2">
                                                                                                <option value="">Select Tax</option>
                                                                                                @foreach($taxs as $tax)
                                                                                                    <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                                                        <input type="hidden" id="tax_code{{$service->id}}" name="tax_code" value="">
                                                                                        <input type="hidden" id="tax_description{{$service->id}}" name="tax_description" value="">
                                                                                        <input type="hidden" id="tax_id{{$service->id}}" name="tax_id" value="">
                                                                                        <input type="hidden" id="taxx{{$service->id}}" name="taxx" value="">
                                                                                        <div class="form-group">
                                                                                            <label for="total">Total </label>
                                                                                            <input type="text" required id="service_total{{$service->id}}" readonly  name="total" value="{{ $service->total }}" class="form-control" placeholder="Total">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <br>
                                                                                            <input class="btn pull-right btn-primary" type="submit" value="Update">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @can('can-delete')
                                                        <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <div class="col-sm-12">
                                    <h3 id="total_amount"><b>Total {{ $currency }} :</b> {{ number_format($quotation->services->sum('total'), 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <h3>Add Require Documents</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select name="required_docs" required id="required_docs" class="form-control">
                                            <option value="">Select Document</option>
                                            @foreach($docs as $service)
                                                <option value="{{$service}}">{{ ucwords($service->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 clearfix">
                                    <button class="btn btn-primary" onclick="addDocs()"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="doc_table">
                                    </tbody>
                                </table>
                                <div class="col-sm-4 pull-right">
                                    <div class="pull-right">
                                        <button onclick="storeServiceData()" class="btn btn-primary pull-right">Add Documents</button>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="col-sm-12">
                            <h4>Required Documents</h4>
                            <table class="table table-strpped">
                                <tr>
                                    <th>Document Name</th>
                                    <th>Description</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                <tbody>
                                @if($quotation->doc_ids != null)
                                    @foreach(json_decode($quotation->doc_ids) as $docs)
                                        <tr>
                                            <td>{{ ucwords($docs->name) }}</td>
                                            <td>{{ ucfirst($docs->description) }}</td>
                                            <td class="text-right"><button onclick="deleteDocs('{{ $docs->doc_id }}','{{ $quotation->id }}')" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <h3>Remarks</h3>
                            <hr>
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
                        <hr>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)

                                            <div class="modal fade bs-example-modal-client" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Message Body</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <form action="{{ url('/client/quotation/send/') }}" onsubmit="cssLoader()" method="post">
                                                                    <div class="row">
                                                                        {{ csrf_field() }}
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="subject">Subject</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" required id="subject" name="subject" class="form-control"
                                                                                               placeholder="Subject">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="name">Client Name</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer ? $quotation->customer->Name : ''}}" required id="name" name="name" class="form-control"
                                                                                               placeholder="Client Name">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="customer_person">Contact Person</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer ? $quotation->customer->Contact_Person :''}}" required id="customer_person" name="customer_person" class="form-control"
                                                                                               placeholder="Contact Person">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="phone">Phone Number</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer ? $quotation->customer->Telephone :''}}" required id="phone" name="phone" class="form-control"
                                                                                               placeholder="Phone Number">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="email">Client Email</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="email" value="{{$quotation->customer ? $quotation->customer->EMail :''}}" required id="email" name="email" class="form-control"
                                                                                               placeholder="Client Email">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <textarea name="message" id="mymce" cols="30"
                                                                                          rows="10" placeholder="Message"
                                                                                          class="form-control"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input class="btn pull-right  btn btn-outline-success" type="submit" value="Send To Customer">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
            }
{{--                                            <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" onclick="cssLoader()" class="btn btn btn-primary">Accepted</a>--}}
{{--                                            <a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" onclick="cssLoader()" class="btn btn-danger" type="submit"> Declined </a>--}}
                                        @endif
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)
                                            {{--                                        <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Download</a>--}}
                                            <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Start Processing</a>
                                        @endif
                                        {{--                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Archive</a>--}}
                                        <a href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>
                                        @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                            @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CHECKED)
                                                <a href="{{ url('/quotation/request/'.$quotation->id) }}" class="btn btn-success" type="submit"> Request Approval </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body">
                    <h4 class="text-center">Waiting For Approval</h4>
                </div>
            @else
                <div class="card card-body printableArea">
                    <h3 class="text-center">{{ $quotation->status }}</h3>
                    <br>
                    <div class="row">
                        @include('partials.quotation.invoice-head')
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">
                                @include('partials.quotation.add-service')
                                <div class="row">
                                    <div class="col-sm-12"><div class="col-sm-4 pull-right">
                                            <div class="pull-right">
                                                <h3 id="total_amount">Total USD : 0</h3>
                                                <button onclick="storeServiceData()" class="btn btn-primary pull-right">Update Quotation</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><br>
                                        <br></div>
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-responsive table-hover">
                                            <thead>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th class="text-right">QUANTITY</th>
                                                <th class="text-right">UNIT PRICE</th>
                                                <th class="text-right">TAX</th>
                                                <th class="text-right">TOTAL AMOUNT</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quotation->services as $service)
                                                <tr id="{{$service->id}}">
                                                    <td> {{ ucwords($service->name) }} </td>
                                                    <td class="text-right">{{$service->total_units}} </td>
                                                    <td class="text-right">{{ number_format($service->selling_price, 2) }}</td>
                                                    <td class="text-right">{{ number_format($service->tax, 2) }}</td>
                                                    <td class="text-right">{{ number_format($service->total, 2) }}</td>
                                                    <td class="text-right">
                                                        <button data-toggle="modal" data-target=".bs-example-modal-lg{{$service->id}}" class="btn btn-xs btn-primary">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <div class="modal fade bs-example-modal-lg{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myLargeModalLabel">Edit Service</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <form style="text-align: left !important;" id="update_service{{$service->id}}" onsubmit="event.preventDefault(); submitForm(this, '/update-service');" action="" method="post">
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label for="name text-left">Description</label>
                                                                                            <input type="text" value="{{ ucwords($service->name) }}" readonly required id="name" name="name" class="form-control" placeholder="Description">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="rate">Unit Price </label>
                                                                                            <input type="text" required id="{{$service->id}}rate" value="{{ $service->selling_price }}" name="rate" class="form-control" placeholder="Unit Price">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="total_units">Quantity</label>
                                                                                            <input type="text" required id="qt{{$service->id}}" onkeyup="updateServiceTotal(this,'{{$service->rate}}')" value="" name="total_units" class="form-control" placeholder="Quantity">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="tax{{$service->id}}">Select Tax</label>
                                                                                            <select style="width: 100% !important;" name="taxs" onchange="onTaxChange('tax{{$service->id}}')" required id="tax{{$service->id}}" class="form-control select2">
                                                                                                <option value="">Select Tax</option>
                                                                                                @foreach($taxs as $tax)
                                                                                                    <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                                                        <input type="hidden" id="tax_code{{$service->id}}" name="tax_code" value="">
                                                                                        <input type="hidden" id="tax_description{{$service->id}}" name="tax_description" value="">
                                                                                        <input type="hidden" id="tax_id{{$service->id}}" name="tax_id" value="">
                                                                                        <input type="hidden" id="taxx{{$service->id}}" name="taxx" value="">
                                                                                        <div class="form-group">
                                                                                            <label for="total">Total </label>
                                                                                            <input type="text" required id="service_total{{$service->id}}" readonly  name="total" value="{{ $service->total }}" class="form-control" placeholder="Total">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <br>
                                                                                            <input class="btn pull-right btn-primary" type="submit" value="Update">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <div class="col-sm-12">
                                    <h3 id="total_amount"><b>Total {{ $currency }} :</b> {{ number_format($quotation->services->sum('total'), 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <h3>Add Require Documents</h3>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select name="required_docs" required id="required_docs" class="form-control">
                                            <option value="">Select Document</option>
                                            @foreach($docs as $service)
                                                <option value="{{$service}}">{{ ucwords($service->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 clearfix">
                                    <button class="btn btn-primary" onclick="addDocs()"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="doc_table">
                                    </tbody>
                                </table>
                                <div class="col-sm-4 pull-right">
                                    <div class="pull-right">
                                        <button onclick="storeServiceData()" class="btn btn-primary pull-right">Add Documents</button>
                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                        <div class="col-sm-12">
                            <h4>Required Documents</h4>
                            <table class="table table-strpped">
                                <tr>
                                    <th>Document Name</th>
                                    <th>Description</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                <tbody>
                                @if($quotation->doc_ids != null)
                                    @foreach(json_decode($quotation->doc_ids) as $docs)
                                        <tr>
                                            <td>{{ ucwords($docs->name) }}</td>
                                            <td>{{ ucfirst($docs->description) }}</td>
                                            <td class="text-right"><button onclick="deleteDocs('{{ $docs->doc_id }}','{{ $quotation->id }}')" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <h3>Remarks</h3>
                            <hr>
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
                                        <td>{{ ucwords($remark->user == null ? 'Client' : $remark->user->name) }}</td>
                                        <td>{{ ucfirst($remark->remark) }}</td>
                                        <td class="text-right">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <div class="col-sm-12">
                                    <div class="text-right">
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)
                                            {{--<a target="_blank" href="{{ url('/quotation/download/'.$quotation->id) }}" class="btn btn btn-outline-success">Download</a>--}}
                                            {{--<button data-toggle="modal" data-target=".bs-example-modal-client" class="btn btn btn-outline-success">--}}
                                                {{--Send To Client--}}
                                            {{--</button>--}}
                                            <div class="modal fade bs-example-modal-client" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Message Body</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                <form action="{{ url('/client/quotation/send/') }}" onsubmit="cssLoader()" method="post">
                                                                    <div class="row">
                                                                        {{ csrf_field() }}
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="subject">Subject</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" required id="subject" name="subject" class="form-control"
                                                                                               placeholder="Subject">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="name">Client Name</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer ? $quotation->customer->Name :''}}" required id="name" name="name" class="form-control"
                                                                                               placeholder="Client Name">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="customer_person">Contact Person</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer->Contact_Person}}" required id="customer_person" name="customer_person" class="form-control"
                                                                                               placeholder="Contact Person">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="phone">Phone Number</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" value="{{$quotation->customer->Telephone}}" required id="phone" name="phone" class="form-control"
                                                                                               placeholder="Phone Number">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                        <label for="email">Client Email</label>
                                                                                    </div>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="email" value="{{$quotation->customer->EMail}}" required id="email" name="email" class="form-control"
                                                                                               placeholder="Client Email">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <textarea name="message" id="mymce" cols="30"
                                                                                          rows="10" placeholder="Message"
                                                                                          class="form-control"></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input class="btn pull-right  btn btn-outline-success" type="submit" value="Send To Customer">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
                                            {{--<a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" onclick="cssLoader()" class="btn btn btn-primary">Accepted</a>--}}
{{--                                            <a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" onclick="cssLoader()" class="btn btn-danger" type="submit"> Declined </a>--}}
                                        @endif
                                        @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)
                                            {{--                                        <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Download</a>--}}
                                            <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Start Processing</a>
                                        @endif
                                        {{--                                <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Archive</a>--}}
                                        <a href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>
                                        @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED
                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                            @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CHECKED)
                                                <a href="{{ url('/quotation/request/'.$quotation->id) }}" class="btn btn-success" type="submit"> Request Approval </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            if ($("#mymce").length > 0) {
                tinymce.init({
                    selector: "textarea#mymce",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }
        });
        var search_item = $('#customer');
        var display_search = $('#display');
        var data = {
            'quotation_id':'{{ $quotation->id }}',
            'currency' : '{{ $currency }}',
            'inputCur' : '{{ $quotation->inputCur }}',
            'exrate' : '{{ $exrate }}',
            'services':{},
            'required_docs' : {}
        }

        search_item.on('keyup', function () {

            if(search_item.val() == "") {
                display_search.html("")
            }
            else {
                axios.post('/search-customer', {'search_item' : search_item.val()})
                    .then( function (response) {
                        display_search.empty().append(response.data.output);
                    })
                    .catch( function (response) {
                        console.log(response.data);
                    });
            }
        });

        $('#currency').empty().append('CURRENCY ' + this.data.currency);

        function addService() {
            var  service_selling = 0;
            var  checkit = 0;
            if($('#service').val() === "" || $('#service').val() === null){
                alert('Select One Service');
                return true;
            }

            if($('#tax').val() === "" || $('#tax').val() === null){
                alert('Select Tax');
                return true;
            }
            var selected = document.getElementById("service")
            var getSelectedService = JSON.parse(selected.options[selected.selectedIndex].value);

            var sTax = document.getElementById("tax");
            var selectedTax = JSON.parse(sTax.options[sTax.selectedIndex].value);
            var service_units = $('#service_units').val();
            service_selling = $('#selling_price').val();
            checkit= this.data.inputCur == 'USD' ? (parseFloat($('#selling_price').val()) * parseFloat(this.data.exrate)) : $('#selling_price').val();

            if(service_units === "" || service_units === null){
                alert('Enter quantity');
            }
            else if (service_selling === "" || service_selling === null){
                alert('Enter Selling price');
            }

            else if(parseFloat(getSelectedService.rate) > parseFloat(checkit)){
                alert('Selling Price Cannot Be Below Buying Price');
            }
            else {
                if(this.data.inputCur == 'KES'){
                    addServiceToData({
                        'id':((Object.keys(this.data.services).length) + 1),
                        'service_id':getSelectedService.id,
                        'rate':this.data.currency == 'USD' ? (parseFloat(getSelectedService.rate) / (this.data.exrate)) : getSelectedService.rate,
                        'stock_link':getSelectedService.StockLink,
                        'selling_price':this.data.currency == 'USD' ?  (parseFloat(service_selling) / parseFloat(this.data.exrate)) : service_selling,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax':this.data.currency == 'USD' ? (parseFloat(((selectedTax.TaxRate * (service_selling * service_units)) / 100)) / parseFloat(this.data.exrate)) : ((selectedTax.TaxRate * (service_selling * service_units)) / 100),
                        'type':getSelectedService.type,
                        'unit':getSelectedService.unit,
                        'total_units':service_units,
                        'name':getSelectedService.name,
                        'total':this.data.currency == 'USD' ? (parseFloat((((selectedTax.TaxRate * (service_selling * service_units)) / 100) + (service_selling * service_units))) / parseFloat(this.data.exrate)) : (((selectedTax.TaxRate * (service_selling * service_units)) / 100) + (service_selling * service_units))
                    })
                }

                else {
                    addServiceToData({
                        'id':((Object.keys(this.data.services).length) + 1),
                        'service_id':getSelectedService.id,
                        'rate': (getSelectedService.rate / this.data.exrate),
                        'stock_link':getSelectedService.StockLink,
                        'selling_price': this.data.currency == 'KES' ? (service_selling * this.data.exrate) : service_selling,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax': this.data.currency == 'KES' ? (parseFloat(((selectedTax.TaxRate * (service_selling * service_units)) / 100)) * parseFloat(this.data.exrate)) : parseFloat(((selectedTax.TaxRate * (service_selling * service_units)) / 100)),
                        'type':getSelectedService.type,
                        'unit':getSelectedService.unit,
                        'total_units':service_units,
                        'name':getSelectedService.name,
                        'total': this.data.currency == 'KES' ? (parseFloat((((selectedTax.TaxRate * (service_selling * service_units)) / 100) +
                            (service_selling * service_units))) * parseFloat(this.data.exrate)) : parseFloat((((selectedTax.TaxRate * (service_selling * service_units)) / 100) +
                            (service_selling * service_units)))
                    })}

            };

            resetForm();
        }

        function updateServiceTotal(service, rate) {

            if(service.value !== ""){
                var total = parseFloat(service.value * $('#'+service.id.slice(2,3)+'rate').val());
                $('#service_total'+service.id.slice(2,3)).val(total);
            }
        }

        function onTaxChange(selected) {
            var theTax = document.getElementById(selected);

            var getTotal = parseFloat($('#qt'+ selected.substr(3)).val() * $('#'+ selected.substr(3)+'rate').val());

            var total = (getTotal + (getTotal * (parseFloat(JSON.parse(theTax.options[theTax.selectedIndex].value).TaxRate)/100)));

            var taxD = JSON.parse(theTax.options[theTax.selectedIndex].value);

            $('#tax_code'+selected.substr(3)).val(taxD.Code)
            $('#tax_description'+selected.substr(3)).val(taxD.Description)
            $('#tax_id'+selected.substr(3)).val(taxD.idTaxRate)
            $('#taxx'+selected.substr(3)).val((getTotal * (parseFloat(JSON.parse(theTax.options[theTax.selectedIndex].value).TaxRate)/100)))
            console.log(taxD.Code, taxD.Description, taxD.idTaxRate,total)
            $('#service_total'+ selected.substr(3)).val(total);
        }

        function resetForm() {
            $('#service').val(1).trigger('change.select2');
            $('#tax').val(1).trigger('change.select2');
            $('#service_units').val('');
            $('#selling_price').val('').removeAttr('readonly');
        }

        function addDocs() {
            var requiredDoc = document.getElementById("required_docs");
            var selectedDoc = JSON.parse(requiredDoc.options[requiredDoc.selectedIndex].value);
            addDocToData({
                'id':Object.keys(this.data.required_docs).length + 1,
                'doc_id': selectedDoc.id,
                'name' : selectedDoc.name,
                'description': selectedDoc.description
            });

        }

        function addDocToData(doc) {
            $('#doc_table').append('<tr id="' + doc.id + '">' +
                '<td>' + doc.name + '</td>' +
                '<td>' + doc.description+ '</td>' +
                '<td class="text-right"><button onclick="deleteDoc(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.required_docs[doc.id] = doc;
        }

        function deleteDoc(doc) {
            var getDoc = doc.parentNode.parentNode;
            getDoc.parentNode.removeChild(getDoc);
            delete this.data.required_docs[getDoc.id];
        }

        function deleteDocs(doc_id, quotation_id) {
            axios.post('{{ url('/delete-doc') }}', {
                'doc_id' : doc_id,
                'quotation_id' : quotation_id,
                '_token' : '{{ csrf_token() }}'
            }).then(function (response) {
                window.location.reload();
            })
                .catch(function (response) {
                    console.log(response);
                });
        }

        function updateServiceTotal(service, rate) {

            if(service.value !== ""){
                $('#service_total'+service.id).val((service.value * ($('#'+service.id+'rate').val())));
            }
        }

        function storeServiceData() {
            cssLoader();
            axios.post('{{url('/add-services')}}', this.data)
                .then( function (response) {
                    stopLoader();
                    window.location.href = '{{ url('/quotation') }}/' + response.data.quotation_id;
                })
                .catch( function (response) {
                    console.log(response.data);
                });

        }

        function deleteService(id) {
            axios.post('{{ url('/quotation-service-delete') }}', {
                'service_id' : id,
                '_token' : '{{ csrf_token() }}'
            }).then(function (response) {
                window.location.reload();
            })
                .catch(function (response) {
                    console.log(response);
                });
        }

        function deleteSerive(service) {
            service_id = service.parentNode.parentNode;

            delete this.data.services[service_id.id];
            service_id.parentNode.removeChild(service_id);
            $('#total_amount').empty().append('<b>Total  :</b>' + getTotal())

        }

        function getTotal() {
            if (Object.keys(this.data.services).length > 0){
                return Object.values(this.data.services).reduce(function (a,b) {
                    return a + b.total;
                },0);
            }
            else{
                return 0;
            }
        }

        function addServiceToData(service) {
            $('#service_table').append('<tr id="' + service.id + '">' +
                '<td>' + service.name + '</td>' +
                '<td class="text-right">' + Number(service.total_units).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.selling_price).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.tax).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.total).toFixed(2)+ '</td>' +
                '<td class="text-right"><button onclick="deleteSerive(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.services[service.id] = service;
            $('#total_amount').empty().append('<b>Total ' + this.data.currency + '  : </b>' + getTotal())

        }

        function fillData(dclink) {
            axios.get('{{ url('/get-customer') }}/' + dclink)
                .then( function (response) {
                    var customer = response.data.customer;

                    $('#add_customer').hide();
                    $('#client_details').empty().append(
                        '<div class="col-sm-12"><h4><b>To</b></h4>'+
                        '<h4 id="client-name"> Name : ' + customer.Name + '</h4>'+
                        '<h4 id="contact-person">Contact Person : ' + customer.Contact_Person + '</h4>'+
                        '<h4 id="contact-phone">Phone : ' + customer.Telephone + '</h4>'+
                        '<h4 id="contact-email">Email : ' + customer.EMail + '</h4></div>'
                    );
                })
                .catch( function (response) {
                    console.log(response.data);
                });

            this.data.DCLink = dclink;
            display_search.empty();
        }
    </script>
@endsection
