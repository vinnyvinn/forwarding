@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Edit Job</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Job</li>
            </ol>
        </div>
      
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
                <h3 class="text-center">{{ ucwords( $dms->customer ? $dms->customer->Name :'')  }}</h3>
                <br>
                <div class="row">
                    <div class="card-body wizard-content">
                        <div class="col-md-12">
                            @if($update)
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Update Job Details</h4>
                                        <div class="col-12">
                                            <form style="text-align: left !important;" id="update_service{{$dms->id}}" action="{{ url('/update-dms') }}" method="post" class="dms_update">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="description">Client Name</label>
                                                            <input type="text" value="{{ ucwords($dms->customer->Name) }}" readonly disabled class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bl_no">{{ $dms->quote->type == 'import' ? 'BL Number' : 'Shipping Order NO' }}</label>
                                                            <input type="text" required value="{{$dms->quote->cargo->bl_no}}" id="bl_no" name="bl_no" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="job_type">Select Job Type</label>
                                                            <select name="job_type"  required id="job_type"
                                                                    class="form-control">
                                                                <option value="">Select Job Type</option>
                                                                @if($dms->quote->type == 'import' )
                                                                <option value="AI" {{$dms->code_name =='AI' ? 'selected="selected"' : ''}}>Air Import</option>
                                                                <option value="SI" {{$dms->code_name =='SI' ? 'selected="selected"' : ''}}>Sea Import</option>
                                                                <option value="RLI" {{$dms->code_name =='RLI' ? 'selected="selected"' : ''}}>Rail Import</option>
                                                                <option value="RI" {{$dms->code_name =='RI' ? 'selected="selected"' : ''}}>Road Import</option>
                                                                @else
                                                                <option value="AE" {{$dms->code_name =='AE' ? 'selected="selected"' : ''}}>Air Export</option>
                                                                <option value="SE" {{$dms->code_name =='SE' ? 'selected="selected"' : ''}}>Sea Export</option>
                                                                <option value="RLE" {{$dms->code_name =='RLE' ? 'selected="selected"' : ''}}>Rail Export</option>
                                                                <option value="RE" {{$dms->code_name =='RE' ? 'selected="selected"' : ''}}>Road Export</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="branch">Branch Short Code</label>
                                                            <input type="text"  id="branch" name="branch" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ctm_ref">Client REF(Optional)</label>
                                                            <input type="text" id="ctm_ref" name="ctm_ref" class="form-control" value="{{$dms->ctm_ref}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="consignee_name">Consignee</label>
                                                            <input type="text" required value="{{$dms->quote->cargo->consignee_name}}" id="consignee_name" name="consignee_name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="entry_number">Entry Number</label>
                                                            <input type="text" required id="entry_number" name="entry_number" class="form-control">
                                                        </div>
                                                        <div class="form-group" style="display: none;">
                                                            <label for="vessel">Vessel Name</label>
                                                            <input type="text"  id="vessel" name="vessel" class="form-control" >
                                                        </div>
                                                        <div class="form-group" style="display: none;">
                                                            <label for="eta">{{ $dms->quote->type == 'import' ? 'ETA' : 'ETD' }}</label>
                                                            <input type="text"  id="eta" name="eta" class="form-control datepicker">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location">Pick-up Point</label>
                                                            <input type="text" required id="location" value="{{$dms->quote->cargo->location}}" name="location" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="destination">Destination</label>
                                                            <input type="text" required id="destination" name="destination" class="form-control" value="{{$dms->destination}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="remarks">Remarks</label>
                                                            <textarea name="remarks" required id="remarks" cols="30" rows="5"
                                                                      class="form-control">{{$dms->remarks}}</textarea></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="client_notification">Notify Customer</label>
                                                            <select name="client_notification" required id="client_notification"
                                                                    class="form-control">

                                                                <option value="hour" {{$dms->client_notification=='hour' ? 'selected="selected"' : ''}}>Every 1 Hour</option>
                                                                <option value="twice" {{$dms->client_notification=='twice' ? 'selected="selected"' : ''}}>Twice Daily</option>
                                                                <option value="once" {{$dms->client_notification=='once' ? 'selected="selected"' : ''}}>Once Daily</option>
                                                                <option value="action" {{$dms->client_notification=='action' ? 'selected="selected"' : ''}}>When an action occurs</option>
                                                                <option value="dont" {{$dms->client_notification=='dont' ? 'selected="selected"' : ''}}>Don't notify customer</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipper">Shipper</label>
                                                            <input type="text" required id="shipper" name="shipper" class="form-control" value="{{$dms->shipper}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipping_line">Shipping Line</label>
                                                            <input type="text" required id="shipping_line" name="shipping_line" class="form-control" value="{{$dms->shipping_line}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="distance">Distance</label>
                                                            <input type="number" required id="distance" name="distance" class="form-control" value="{{$dms->distance}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cargo_name">Cargo Description</label>
                                                            <input type="text" required id="cargo_name" value="{{$dms->quote->cargo->cargo_name}}" name="cargo_name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="manifest">Manifest</label>
                                                            <input type="text" required id="manifest" value="{{$dms->quote->cargo->manifest}}" name="manifest" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cargo_qty">Cargo Quantity</label>
                                                            <input type="text" required id="cargo_qty" value="{{$dms->quote->cargo->cargo_qty}}" name="cargo_qty" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cargo_weight">Total Cargo Weight</label>
                                                            <input type="number" required id="cargo_weight" value="{{$dms->quote->cargo->cargo_weight}}" name="cargo_weight" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="container_no">Container NO</label>
                                                            <input type="text" required id="container_no" value="{{$dms->quote->cargo->container_no}}" name="container_no" class="form-control">
                                                        </div>
                                                        <input type="hidden" name="dms_id" value="{{ $dms->id }}">

                                                        <div class="form-group">
                                                            <br>
                                                            <input class="btn text-center btn-primary vinn_update" type="submit" value="Update">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Client Details</h4>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pda" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Client Documents</span>
                                            </a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#images" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Cargo Images</span>
                                            </a> </li>
                                                                               <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#checklist1" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">DSR</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#delivery" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Delivery Docs</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#complete" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Complete</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cost" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> Project Cost</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#purchase-order" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down"> Purchase Order</span></a> </li>
                                        {{--@foreach(\App\Stage::all() as $value)--}}
                                            {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#{{ str_slug($value->name) }}" role="tab">--}}
                                                    {{--<span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">{{ ucwords($value->name) }}</span></a> </li>--}}
                                            {{--@endforeach--}}

                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="pda" role="tabpanel">

                                            <div class="p-20">
                                                <div class="col-sm-12">
                                                    <h4>Client Documents</h4>
                                                    <br>
                                                    <div class="col-sm-12">
                                                        @foreach($dms->quote->docs as $doc)
                                                            {{ $loop->iteration }} . <a href="{{ url($doc->doc_path) }}" target="_blank" >{{ $doc->name }}</a>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                </div>
                                                <a href="{{ url('quotation/'.$dms->quote_id) }}" target="_blank" class="btn btn-success">Running Quote</a>
                                                <button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-info">
                                                    Upload Client Doc
                                                </button>
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    @if($dms->quote->doc_ids != null)
                                                                        <form class="form-material m-t-40" action="{{ url('/vessel/doc/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                            <div class="row">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="vessel_id" value="{{ $dms->quote->id }}">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="name">Select Document</label>
                                                                                        <select name="name" id="name" required
                                                                                                class="form-control">
                                                                                            <option value="">Select Docs</option>
                                                                                            @foreach(json_decode($dms->quote->doc_ids) as $doc)
                                                                                                <option value="{{ $doc->name }}">{{ $doc->name }}</option>
                                                                                                @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="doc">Select Doc</label>
                                                                                        <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Upload">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        @else
                                                                    <h4>No Required File</h4>
                                                                        @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="images" role="tabpanel">
                                            <div class="p-20">
                                                <div class="col-sm-12">
                                                    <h4>Cargo Images</h4>
                                                    <br>
                                                    <div class="col-sm-12">
                                                        @foreach($dms->images as $image)
                                                            {{ $loop->iteration }} . <a href="{{ url($image->image_path) }}" target="_blank" >{{ $image->image_path }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button data-toggle="modal" data-target=".bs-example-modal-lgcargo" class="btn btn-info">
                                                    Add Cargo
                                                </button>


                                                <div class="modal fade bs-example-modal-lgcargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload Cargo Image</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/cargo/image/upload/') }}" method="post" enctype="multipart/form-data" id="cargo_images">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="bill_of_landing_id" value="{{ $dms->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="images">Select Images</label>
                                                                                    <input type="file" required id="images" name="images" class="form-control" placeholder="Select Images">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn pull-right btn-primary" type="submit" value="Upload">
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

                                            </div>
                                        </div>

                                            <div class="tab-pane p-20" id="checklist1" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4>Details <strong class="pull-right">Date started : {{ \Carbon\Carbon::parse($dms->created_at)->format('d-M-y') }}</strong></h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-stripped">
                                                            <tbody>
                                                            <tr>
                                                                <td><strong>ESL REF : </strong> {{ strtoupper($dms->file_number) }}</td>
                                                                <td><strong>Client REF : </strong> {{ strtoupper($dms->ctm_ref) }}</td>
                                                                <td><strong>BL NO : </strong> {{ strtoupper($dms->bl_number) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Cargo Weight : </strong> {{ strtoupper($dms->cargo_weight) }} Tonne</td>
                                                                <td><strong>Shipper : </strong> {{ strtoupper($dms->shipper) }}</td>
                                                                <td><strong>Shipping Lines : </strong> {{ strtoupper($dms->shipping_line)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Distance : </strong> {{ strtoupper($dms->distance) }}</td>
                                                                <td><strong>Pick up Point : </strong> {{ strtoupper($dms->start) }}</td>
                                                                <td><strong>Destination : </strong> {{ strtoupper($dms->destination)}}</td>
                                                            </tr><tr>
                                                                <td colspan="3"><strong>Description : </strong> {{ strtoupper($dms->desc)}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button data-toggle="modal" data-target=".bs-example-modal-dsr" class="btn btn-info">
                                                        Edit DSR
                                                    </button>
                                                    <a href="{{ url('dsr/'.$dms->Client_id) }}" class="btn btn-warning pull-right">
                                                        View DSR
                                                    </a>
                                                    <hr>
                                                </div>
                                                <div class="modal fade bs-example-modal-dsr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Edit DSR</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{url('update-dsr')}}" method="post">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="id" value="{{ $dms->id }}">

                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="file_number">ESL REF</label>
                                                                                    <input type="text" required id="file_number" name="file_number" class="form-control" value="{{$dms->file_number}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="ctm_ref">Client REF</label>
                                                                                    <input type="text" required id="ctm_ref" name="ctm_ref" class="form-control" value="{{$dms->ctm_ref}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="bl_number">BL N</label>
                                                                                    <input type="text" required id="bl_number" name="bl_number" class="form-control" value="{{$dms->bl_number}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="cargo_weight">Cargo Weight</label>
                                                                                    <input type="text" required id="cargo_weight" name="cargo_weight" class="form-control" value="{{$dms->cargo_weight}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="shipper">Shipper</label>
                                                                                    <input type="text" required id="shipper" name="shipper" class="form-control" value="{{$dms->shipper}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="shipping_line">Shipping Lines</label>
                                                                                    <input type="text" required id="shipping_line" name="shipping_line" class="form-control" value="{{$dms->shipping_line}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="distance">Distance</label>
                                                                                    <input type="number" required id="distance" step="0.01" name="distance" class="form-control" value="{{$dms->distance}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="start">Pick up Point</label>
                                                                                    <input type="text" required id="start" name="start" class="form-control" value="{{$dms->start}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="destination">Destination</label>
                                                                                    <input type="text" required id="destination" name="destination" class="form-control" value="{{$dms->desc}}">
                                                                                </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="description">Description</label>
                                                                                        <textarea name="desc" id="description"
                                                                                                  cols="30"
                                                                                                  rows="5" class="form-control">{{$dms->desc}}</textarea>
                                                                                </div></div>
                                                                                <div class="form-group">
                                                                                    <input class="btn pull-right btn-primary" type="submit" value="Update">
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger waves-effect pull-left" data-dismiss="modal" style="margin-top: -16px">Close</button>
                                                                                    </div>
                                                                                </div>


                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @foreach($checklist as $key => $values)
                                                    <h3>{{ ucwords($key) }}</h3>
                                                    <table class="table table-responsive table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th><b>Checklist</b></th>
                                                            <th><b>Type</b></th>
                                                            <th><b>Data</b></th>
                                                            <th><b>Notification</b></th>
                                                            <th><b>Timing</b></th>
                                                            <th><b>Time Taken</b></th>
                                                            <th><b>Sub checklist</b></th>
                                                            <th class="text-right"><b>Date Added</b></th>
                                                        </tr>
                                                        </thead>
                                                    @foreach($values as $inn)

                                                                <tbody>
                                                                <tr>
                                                                    <th>{{ ucwords($inn[$key]['name'] )}}</th>
                                                                    <th>{{ ucwords($inn[$key]['type']) }}</th>
                                                                    @if($inn[$key]['type'] == 'text' || $inn[$key]['type'] == 'checkbox')
                                                                        <th>{!!  $inn[$key]['type'] == 'text' || $inn[$key]['type'] == 'checkbox' ? ucfirst($inn[$key]['text'])  : implode("<br>",$inn[$key]['doc_links'])  !!}</th>
                                                                    @else
                                                                        <th>
                                                                            @foreach($inn[$key]['doc_links'] as $link)
                                                                                <a href="{{ url($link) }}" target="_blank">{{$link}} <br></a>
                                                                            @endforeach
                                                                        </th>
                                                                    @endif
                                                                    <th>{!! $inn[$key]['notification'] ? '<i class="fa fa-bell"></i>' : '<i class="fa fa-bell-slash"></i>'  !!}</th>
                                                                    <th>{!! $inn[$key]['timing']   !!} Mins</th>
                                                                    <th>{{ \Carbon\Carbon::parse($dms->created_at)->diffInMinutes(\Carbon\Carbon::parse( $inn[$key]['created_at'])) }} Mins</th>
                                                                    <th>{{ $inn[$key]['subchecklist'] != null ? implode(',',json_decode($inn[$key]['subchecklist'])) : ''}}</th>
                                                                    <th class="text-right">{{ \Carbon\Carbon::parse( $inn[$key]['created_at'])->format('d-M-y') }}</th>
                                                                </tr>
                                                                </tbody>

                                                @endforeach
                                                    </table>
                                                @endforeach
                                            </div>
                                        {{--@endforeach--}}
                                        <div class="tab-pane  p-20" id="delivery" role="tabpanel">
                                            <div class="col-sm-12">
                                                <table class="table table-stripped">
                                                    <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Mode</th>
                                                        <th>Document</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dms->deliverynotes as $deliverynote)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{ $deliverynote->driver }}</td>
                                                            <td>{{ $deliverynote->vehicle }}</td>
                                                            <td><a href="{{ url($deliverynote->doc_path)}}">{{ $deliverynote->doc_path }}</a></td>
                                                            <td>{{ \Carbon\Carbon::parse($deliverynote->created_at)->format('d-M-y') }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button data-toggle="modal" data-target=".bs-example-modal-lgdoc" class="btn btn-info">
                                                Upload Delivery Note
                                            </button>
                                            <div class="modal fade bs-example-modal-lgdoc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Upload Delivery Note</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/delivery/note/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="bol_id" value="{{ $dms->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="driver">Name</label>
                                                                                    <input type="text" required id="driver" name="driver" class="form-control" placeholder="Driver Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="vehicle">Mode of Deliver</label>
                                                                                    <input type="text" required id="vehicle" name="vehicle" class="form-control" placeholder="Vehicle">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="doc">Select Doc</label>
                                                                                    <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn btn-block btn-primary" type="submit" value="Upload">
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
                                            @if($dms->deliverynotes == null)
                                                <h4>No Delivery Note</h4>
                                            @endif
                                        </div>
                                        <div class="tab-pane  p-20" id="complete" role="tabpanel">
                                            <div class="card card-body">
                                                <div class="pull-right">
                                                    <div class="col-sm-4 pull-right">
                                                        <a href="{{ url('/complete-ctm/'.$dms->id) }}" class="btn btn-danger">Are You Sure?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="cost" role="tabpanel">
                                            <div class="card card-body">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                       <button data-toggle="modal" data-target=".bs-example-modal-reqfund" class="btn btn-info">
                                                           Request Fund
                                                       </button>

                                                       <button data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-info">
                                                           Add Project Service Cost
                                                       </button>

                                                       <button data-toggle="modal" data-target=".bs-example-modal-allreqfund" class="btn btn-success">
                                                           View Requested Fund
                                                       </button>

                                                       <button data-toggle="modal" data-target=".bs-example-modal-statement" class="btn btn-success">
                                                           Project Statement
                                                       </button>
                                                   </div>
                                                    <div class="modal fade bs-example-modal-servicecost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Add Service Cost</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form action="{{ url('service-cost') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                            <div class="row">
                                                                                {{ csrf_field() }}
                                                                                <div class="col-sm-12">
                                                                                    <input type="hidden" name="quotation_id" VALUE="{{ $dms->quote->id }}">

                                                                                    <div class="form-group">
                                                                                        <label for="service_id">Select Service</label>
                                                                                        <select name="service_id" id="service_id"
                                                                                                class   g="form-control" required>
                                                                                            <option value="">Select Service</option>
                                                                                            @foreach($dms->quote->services as $service)
                                                                                                @if($service->buying_price == null || $service->buying_price == 0)
                                                                                                <option value="{{$service->id}}">{{ ucwords($service->name) }} ~ SP : {{ number_format($service->selling_price,2) }}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="buying_price">Service Buying Amount</label>
                                                                                        <input type="number" max="{{ $dms->quote->services->sum('selling_price') }}" required id="buying_price" name="buying_price" class="form-control" placeholder="Service Buying Amount">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="description">Description</label>
                                                                                        <input type="text" required id="description" name="description" class="form-control" placeholder="Description">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="doc_path">Select Supporting Doc</label>
                                                                                        <input type="file" required id="doc_path" name="doc_path" class="form-control" placeholder="Select Supporting Doc">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Add">
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
                                                    <div class="modal fade bs-example-modal-reqfund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Request Fund</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <form action="{{ route('project-cost.store') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                            <div class="row">
                                                                                {{ csrf_field() }}
                                                                                <div class="col-sm-12">
                                                                                    <input type="hidden" name="quotation_id" VALUE="{{ $dms->quote->id }}">
                                                                                    <input type="hidden" name="user_id" VALUE="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                                                                    <div class="form-group">
                                                                                        <label for="employee_number">Employee Number/ID</label>
                                                                                        <input type="text" required id="employee_number" name="employee_number" class="form-control" placeholder="Employee Number/ID">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="amount">Amount Requested</label>
                                                                                        <input type="number" required id="amount" name="amount" class="form-control" placeholder="Amount Requested">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="currency">Select Currency</label>
                                                                                        <select name="currency_type" id="currency" class="form-control">
                                                                                            <option value="KSH">KSH</option>
                                                                                            <option value="USD">USD</option>

                                                                                        </select>


                                                                                    </div>
                                                                                   
                                                                                    <div class="form-group">
                                                                                        <label>Select Voucher Type</label>
                                                                                        <select name="vouchertype" class="form-control">
                                                                                            @foreach($vouchertype as $vtype)
                                                                                            <option value="{{$vtype->iVoucherTypeID}}">{{ $vtype->cVoucherDescr}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="deadline">Deadline</label>
                                                                                        <input type="text" required id="deadline" name="deadline" class="form-control datepicker" placeholder="Deadline">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="reason">Reason</label>
                                                                                        <textarea name="reason" id="reason"
                                                                                                  cols="30" rows="3"
                                                                                                  class="form-control"></textarea>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="file_path">Select Supporting Doc</label>
                                                                                        <input type="file" id="file_path" name="file_path" class="form-control" placeholder="Select Supporting Doc">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input class="btn btn-block btn-primary" type="submit" value="Send Request">
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
                                                    <div class="modal fade bs-example-modal-allreqfund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">All Requested Fund</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <table class="table table-stripped">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Employee</th>
                                                                                        <th>Em NO/ID</th>
                                                                                        <th>Deadline</th>
                                                                                        <th>Reason</th>
                                                                                        <th>S/File</th>
                                                                                        <th>Status</th>
                                                                                        <th>Amount</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($dms->quote->pettyCash as $cash)
                                                                                        @if(\Illuminate\Support\Facades\Auth::id() == $cash->user_id)
                                                                                        <tr>
                                                                                            <td>{{ ucwords($cash->user->name) }}</td>
                                                                                            <td>{{ $cash->employee_number }}</td>
                                                                                            <td>{{ \Carbon\Carbon::parse($cash->deadline)->format('d-M-y') }}</td>
                                                                                            <td>{{ $cash->reason }}</td>
                                                                                            <td><a target="_blank" href="{{ asset($cash->file_path) }}">{{ $cash->file_path == ' ' ? '' : 'File' }}</a></td>
                                                                                            <td>{{ $cash->status == 0 ? 'Not Approved' : 'Approved' }}</td>
                                                                                            <td>{{ number_format($cash->amount, 2) }}</td>
                                                                                            <td>
                                                                                                @if($cash->status == 0)
                                                                                                <a href="{{ url('/approve-project-cost-request/'.$cash->id) }}"
                                                                                                   class="btn btn-xs btn-primary">approve</a>
                                                                                                @endif
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                    <tr>
                                                                                        <th colspan="6">Total</th>
                                                                                        <th>{{ number_format($dms->quote->pettyCash->sum('amount'), 2) }}</th>
                                                                                    </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade bs-example-modal-statement" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">Project Statement</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <table class="table table-stripped">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>Service Name</th>
                                                                                        <th>Receipt</th>
                                                                                        <th>Selling Price</th>
                                                                                        <th>Cost</th>
                                                                                        <th>Profit</th>
                                                                                        {{--<th>Action</th>--}}
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @foreach($dms->quote->services as $service)
                                                                                            <tr>
                                                                                                <td>{{ ucwords($service->name) }}</td>
                                                                                                <td><a target="_blank" href="{{ url(asset($service->doc_path == null ? '' : $service->doc_path)) }}">{{ $service->doc_path == null ? '' : 'Download'}}</a></td>
                                                                                                <td>{{ number_format($service->selling_price,2)}}</td>
                                                                                                <td>{{ $service->buying_price == null ? 'Add Service Cost' : number_format($service->buying_price,2) }}</td>
                                                                                                <td>{{ $service->buying_price == null ? 'Add Service Cost' : number_format(($service->selling_price - $service->buying_price),2) }}</td>
                                                                                                {{--<td>--}}
                                                                                                    {{--<button data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-xs btn-success" data-dismiss="modal">--}}
                                                                                                        {{--<i class="fa fa-pencil"></i>--}}
                                                                                                    {{--</button>--}}
                                                                                                {{--</td>--}}
                                                                                            </tr>
                                                                                    @endforeach
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                    <tr>
                                                                                        <th colspan="2">Total</th>
                                                                                        <th>{{ number_format($dms->quote->services->sum('selling_price'), 2) }}</th>
                                                                                        <th>{{ number_format($dms->quote->services->sum('buying_price'), 2) }}</th>
                                                                                        <th>{{ number_format(($dms->quote->services->sum('selling_price') - $dms->quote->services->sum('buying_price')), 2) }}</th>
                                                                                    </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button data-toggle="modal" data-target=".bs-example-modal-servicecost" class="btn btn-info" data-dismiss="modal">
                                                                        Add Project Service Cost
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="purchase-order" role="tabpanel">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h4>Purchase Orders <a href="{{ url('generate-po/'.$dms->quote->id) }}" class="btn btn-info btn-sm pull-right">
                                                                Generate Purchase Order
                                                            </a></h4>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-stripped">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Supplier</th>
                                                                <th>Created By</th>
                                                                <th>Status</th>
                                                                <th>PO Date</th>
                                                                {{--@can('managerd')--}}
                                                                <th class="text-right">Action</th>
                                                                {{--@endcan--}}
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($dms->quote->purchaseOrder as $po)
                                                                <tr>
                                                                    <td>{{ strtoupper($po->po_no) }}</td>
                                                                    <td>{{ ucwords($po->supplier->Name) }}</td>
                                                                    <td>{{ ucwords($po->user->name) }}</td>
                                                                    <td><button class="btn btn-xs btn-{{ $po->status == \Esl\helpers\Constants::PO_REQUEST ? 'primary' : ($po->status == \Esl\helpers\Constants::PO_APPROVED ? 'success' : 'danger') }}">{{ ucwords($po->status) }}</button></td>
                                                                    <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d-M-y') }}</td>
                                                                    <td class="text-right"><a href="{{ url('/view-po/'. $po->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
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
                            </div>
                            @foreach($stages as $stage)
{{--                                @if(strtoupper($dms->quote->type) == strtoupper($stage->type))--}}
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ ucwords($stage->name) }}</h4>
                                        <form action="{{ url('/dms/store/') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <table class="table table-stripped">
                                                <tbody>
                                                @foreach($stage->components as $component)
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                {{ ucfirst($component->name) }}
                                                            </div>
                                                            <div class="col-sm-1">
                                                                {!! $component->notification == true ? '<i class="fa fa-bell"></i>' : '<i class="fa fa-bell-slash"></i>' !!}
                                                            </div>
                                                            <div class="col-sm-2">
                                                                Time allowed {{ $component->timing }} Mins
                                                            </div>
                                                            <input type="hidden" name="stage_component_id[]" value="{{$component->id}}">
                                                            <input type="hidden" name="dms_id" value="{{$dms->id}}">
                                                            <div class="col-sm-2 form-group">
                                                                <input name="{{  $component->type == 'file' ? 'doc_links' : 'text_value'}}[{{$component->id}}][]" placeholder="{{ucfirst($component->name)}}" class="form-control" {{ $component->required == true ? 'required' : '' }} type="{{ $component->type == 'file' ? 'file' : 'text' }}" multiple {{ $component->type == 'file' ? 'multiple' : '' }} >
                                                            </div>
                                                            @if($component->components != null )
                                                                <div class="col-sm-2">
                                                                    <i class="btn btn-success model_img img-responsive fa fa-check" data-toggle="modal" data-target="#responsive-modal{{$component->id}}">Sub checklist</i>
                                                                    <!-- sample modal content -->
                                                                    <div id="responsive-modal{{$component->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">{{ ucwords($stage->name)  }} Sub checklist</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="col-sm-12">
                                                                                        <ul class="icheck-list">
                                                                                            @foreach(json_decode($component->components) as $item)
                                                                                                <div class="form-group">
                                                                                                    <input type="checkbox" name="checklist[{{$component->id}}][{{$item}}][]" class="check" id="{{$item}}">
                                                                                                    <label for="{{$item}}">{{ $item }}</label>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                  </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-sm-3 form-group">
                                                                <input name="remark[{{$component->id}}][]" placeholder="Remarks" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary pull-right">Save</button>
                                        </form>
                                    </div>
                                </div>
                                    {{--@endif--}}
                            @endforeach
                                @endif
                                {{--<div class="card">--}}
                                    {{--<div class="card-body">--}}
                                        {{--<form id="pda_remarks_form" action="{{ url('/ctm-remarks') }}" method="post">--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="remarks">Remarks</label>--}}
                                                {{--<textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>--}}
                                            {{--</div>--}}
                                            {{--<input type="hidden" name="ctm_id" id="ctm_id" value="{{ $dms->id }}">--}}
                                            {{--<button type="submit" class="btn btn-primary pull-right">--}}
                                                {{--Submit--}}
                                            {{--</button>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.dms_update').on('submit',function () {

            $('.vinn_update')
                .val("Please Wait")
                .attr("disabled","disabled");
        });
        function addSof(form, formUrl){

            var formId = form.id;

            var vessel = $('#'+formId);

            console.log(vessel);

            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            console.log(data);
            axios.post(formUrl, data)
                .then(function (response) {
                    var details = response.data.success;

                    $('#sof_list').append(details);
                    $('#modal').modal('hide');

                })
                .catch(function (response) {
                    console.log(response.data);
                });

        }
    </script>
@endsection
