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
                <h3 class="text-center">PROFORMA DISBURSEMENT ACCOUNT</h3>
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
                                <h3> &nbsp;<b>TO : {{ ucwords($customer->name) }}</b></h3>
                                <h4 class="m-l-5"><strong>Contact Person : </strong> {{ ucwords($customer->contact_person) }}
                                    <br/> <strong>Tel/Email : </strong> {{ $customer->telephone }} {{ $customer->email }}
                                    <br/> <strong>Phone : </strong> {{ $customer->phone }}
                                </h4>
                                <br>
                                {{--<h3><b>CARGO  {{ ucwords($customer->name) }}</b></h3>--}}
                                {{--<h3><b>DISCHARGE RATE  {{ ucwords($customer->name) }}</b></h3>--}}
                                {{--<h3><b>PORT STAY  </b>{{ ucwords($customer->name) }}</h3>--}}

                            </address>
                        </div>
                        <div class="pull-right">
                            <div class="row">
                                <div class="form-group">
                                    <h3> <b>Tax Registration :</b> 0121303W</h3>
                                    <h3><b>Telephone :</b> +254 41 2229784</h3>
                                </div>
                            </div>
                            <address>
                                {{--<h4><b>Job No</b> ESL002634</h4>--}}
                                {{--<h4><b>Voyage No</b> TBA</h4>--}}
                                {{--<h4>Currency : USD</h4>--}}
                                {{--<h4 id="vessel_name"><b>VESSEL</b> MV TBN</h4>--}}
                                {{--<h4 id="grt"><b>GRT</b> 43753 GT</h4>--}}
                                {{--<h4 id="loa"><b>LOA</b> 229 M</h4>--}}
                                {{--<h4 id="port"><b>PORT</b> KEMBA</h4>--}}
                                {{--<p><b>Date :</b>23rd Jan 2017</p>--}}
                            </address>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body wizard-content">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Customer Request Details</h4>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a> </li>
                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="p-20">
                                                <form class="form-material m-t-40" onsubmit="event.preventDefault();submitForm(this, '/vessel-details','redirect');" action="" id="vessel">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="name">Vessel Name</label>
                                                                <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                            </div>
                                                            <input type="hidden" name="lead_id" value="{{ $customer->id }}">
                                                            <div class="form-group">
                                                                <label for="call_sign">Call Sign</label>
                                                                <input type="text"  id="call_sign" name="call_sign" class="form-control" placeholder="Call Sign">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="imo_number">IMO Number </label>
                                                                <input type="text"  id="imo_number" name="imo_number" class="form-control" placeholder="IMO Number">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="discharge_rate">Discharge Rate </label>
                                                                <input type="number"  id="discharge_rate" name="discharge_rate" class="form-control" placeholder="Discharge Rate">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="country">Country </label>
                                                                <input type="text" required id="country" name="country" class="form-control" placeholder="Country">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="port_of_discharge"> Port of Discharge</label>
                                                                <input type="text" id="port_of_discharge"  name="port_of_discharge" class="form-control" placeholder="Port of Discharge">
                                                            </div>
                                                            <div class="form-group">

                                                                <label for="port_of_loading"> Port of Loading</label>
                                                                <input type="text" id="port_of_loading"  name="port_of_loading" class="form-control" placeholder="Port of Loading">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="loa">Length Over All </label>
                                                                <input type="text" id="loa" name="loa" required class="form-control" placeholder="Lenth Over All">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="grt">Gross Tonnage  GRT</label>
                                                                <input type="text" id="grt" name="grt" required class="form-control" placeholder="Gross Tonnage ">
                                                            </div>
                                                          <div class="form-group">
                                                                <label for="consignee_good"> Cargo Tonnage </label>
                                                                <input type="text" id="consignee_good" required name="consignee_good" class="form-control" placeholder="Cargo Weight">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nrt"> Net Tonnage</label>
                                                                <input type="text" id="nrt" name="nrt"  class="form-control" placeholder="Net Tonnage">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dwt"> Dead Weight - including provision</label>
                                                                <input type="text" id="dwt" name="dwt"  class="form-control" placeholder="Dead Weight - including provision">
                                                            </div>
                                                            <div class="form-group">
                                                                <br>
                                                                <input class="btn btn-block btn-primary" type="submit" value="Save">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection