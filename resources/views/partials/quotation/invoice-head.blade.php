<div class="col-md-12">
    <div class="pull-left">
        <address>
            <img src="{{ asset('images/logo.png') }}" alt="">
            <p style="font-size: smaller"><br> Powering Our Customers to be Leaders in their Markets</p>
            <h4>Cannon Towers, <br>6th Floor, Moi Avenue Mombasa - Kenya <br>
                Email : info@freightwell.com <br> imports@freightwell.com <br>
                Web: www.esl-eastafrica.com</h4>
        </address>
    </div>
    <div class="pull-right">
        <address id="client_details">
            <h3>{{ isset($quotation) ? $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED ? 'Quotation' : 'Proforma Invoice' : ''}} </h3>
             <?php $quote = $quotation->quote_id ? $quotation->quote_id :$quotation->id;?>
            <h4>#QU00{{$quote.'/'.\Carbon\Carbon::parse($quotation->created_at)->format('y')}}</h4>
            <h4>Tax Registration: P051153405J</h4>
            <h4>Telephone: +254 41 2229784</h4>
        </address>
    </div>
</div>
<div class="col-sm-12">
    <hr>
</div>
<div class="col-md-12">
    <div class="pull-left">
        <address>
            <h4><b>To</b></h4>
            <h4>Name : {{ ucwords($quotation->customer ? $quotation->customer->Name :'') }} </h4>
            <h4>Contact Person : {{ mb_strimwidth(ucwords($quotation->customer ? $quotation->customer->Contact_Person :''),0,16,"...") }} </h4>
            <h4>Phone : {{ $quotation->customer ? $quotation->customer->Telephone:'' }} </h4>
            <h4>Email :  {{ $quotation->customer ? $quotation->customer->EMail :''}}</h4>
            <br>
            <p><b>Date : </b> {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</p>
        </address>
    </div>
    <div class="pull-right text-left">
        <address id="client_details">
            <h4><b>B/L NO: </b>{{ strtoupper($quotation->cargo->bl_no )}}</h4>
            <h4><b>CARGO: </b>{{ strtoupper($quotation->cargo->cargo_name )}}</h4>
            <h4><b>VESSEL/DSTN: </b>{{ strtoupper($quotation->cargo->vessel_name )}}</h4>
            <h4><b>QUANTITY: </b>{{ strtoupper($quotation->cargo->cargo_qty )}}</h4>
            <h4><b>WEIGHT: </b>{{ strtoupper($quotation->cargo->cargo_weight )}}</h4>
            <h4><b>C'NER: </b>{{ strtoupper($quotation->cargo->container_no )}}</h4>
            <h4><b>CONSIGNEE: </b>{{ strtoupper($quotation->cargo->consignee_name )}}</h4>
        </address>
    </div>
</div>
<button data-toggle="modal" data-target=".bs-example-modal-details" class="btn btn-info" style="display: none">
    Edit Details
</button>
<div class="modal fade bs-example-modal-details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit DSR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <form class="form-material m-t-40" action="{{url('update-quote')}}" method="post">
                        <div class="row">
                            {{ csrf_field() }}
                            <input type="hidden" name="cargo_id" value="{{$quotation->cargo->id}}">
                            <input type="hidden" name="customer_id" value="{{$quotation->customer ? $quotation->customer->id :''}}">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Name">Customer Name</label>
                                    <input type="text" required id="Name" name="Name" class="form-control" value="{{$quotation->customer ? $quotation->customer->Name :''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Contact_Person">Contact Person</label>
                                    <input type="text" required id="Contact_Person" name="Contact_Person" class="form-control" value="{{$quotation->customer ? $quotation->customer->Contact_Person :''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Telephone">Phone</label>
                                    <input type="text" required id="Telephone" name="Telephone" class="form-control" value="{{$quotation->customer ? $quotation->customer->Telephone :''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="EMail">Email</label>
                                    <input type="text" required id="EMail" name="EMail" class="form-control" value="{{$quotation->customer ? $quotation->customer->EMail :''}}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="bl_no">B/L NO</label>
                                    <input type="text" required id="bl_no" name="bl_no" class="form-control" value="{{$quotation->cargo->bl_no}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cargo_name">CARGO</label>
                                    <input type="text" required id="cargo_name" name="cargo_name" class="form-control" value="{{$quotation->cargo->cargo_name}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vessel_name">VESSEL/DSTN</label>
                                    <input type="text" required id="vessel_name"  name="vessel_name" class="form-control" value="{{$quotation->cargo->vessel_name}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cargo_qty">QUANTITY</label>
                                    <input type="number" required id="cargo_qty" name="cargo_qty" class="form-control" value="{{$quotation->cargo->cargo_qty}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="cargo_weight">WEIGHT</label>
                                    <input type="text" required id="cargo_weight" name="cargo_weight" class="form-control" value="{{$quotation->cargo->cargo_weight}}">
                                </div>
                            </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="container_no">C'NER</label>
                                    <input type="text" required id="container_no" name="container_no" class="form-control" value="{{$quotation->cargo->container_no}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="consignee_name">CONSIGNEE</label>
                                    <input type="text" required id="consignee_name" name="consignee_name" class="form-control" value="{{$quotation->cargo->consignee_name}}">
                                </div>
                            </div>

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
<div class="col-sm-12">
    <hr>
</div>
