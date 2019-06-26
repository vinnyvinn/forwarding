@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Quotation</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Quotation</li>
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
                                {{--<h4><b>Voyage No</b> TBA</h4>--}}
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
                            <h3>Add Tariff Service</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select name="tariff" required id="tariff" class="form-control">
                                            @foreach($tariffs as $tariff)
                                                <option value="{{$tariff}}">{{ ucwords($tariff->name) }} ~ {{ ucwords($tariff->unit) }}({{$tariff->unit_value}}) @ {{ $tariff->rate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="number" required id="service_units" name="service_units" placeholder="Units" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-primary" onclick="addTariff()"><i class="fa fa-check"></i></button>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-striped table-responsive">
                                        <thead>
                                        <tr>
                                        <tr>
                                            <th>Description</th>
                                            <th class="text-right">GRT/LOA</th>
                                            <th class="text-right">RATE</th>
                                            <th class="text-right">UNITS</th>
                                            <th class="text-right">Tax</th>
                                            <th class="text-right">Total (Incl)</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </tr>
                                        </thead>
                                        <tbody id="service">
                                        </tbody>
                                    </table>
                                    <button onclick="addServiceToQuotaion()" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">GRT/LOA</th>
                                    <th class="text-right">RATE</th>
                                    <th class="text-right">UNITS</th>
                                    <th class="text-right">Tax</th>
                                    <th class="text-right">Total (Incl)</th>
                                    <th class="text-right">Action</th>
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
                                                                                <label for="description text-left">Description <span class="help">(Customer or Company Name)</span></label>
                                                                                <input type="text" value="{{ ucwords($service->description) }}" required id="description" name="description" class="form-control" placeholder="Description">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="grt_loa">GRT/LOA</label>
                                                                                <input type="text" required id="grt_loa" value="{{ $service->grt_loa  }}" name="grt_loa" class="form-control" placeholder="GRT/LOA" readonly>
                                                                            </div>
                                                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                                            <input type="hidden" name="tariff_type" value="{{ $service->tariff->type }}">
                                                                            <div class="form-group">
                                                                                <label for="rate">Rate </label>
                                                                                <input type="text" required id="rate" {{ $service->tariff->type == \Esl\helpers\Constants::TARIFF_KPA ? 'readonly' : ' ' }} value="{{ $service->rate }}" name="rate" class="form-control" placeholder="Rate">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="units">Units </label>
                                                                                <input type="text" required id="units" name="units" value="{{ $service->units }}" class="form-control" placeholder="Units">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <br>
                                                                                <input class="btn btn-block btn-primary" type="submit" value="Update">
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
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
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
                        <hr>
                        <div class="col-sm-12">
                            <form id="pda_remarks_form" action="" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">
                            </form>
                            <div class="text-right">
                                <a href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>
                                <button  class="btn btn-danger" onclick="event.preventDefault(); disapprove()"> DISAPPROVE </button>
                                <button class="btn btn-primary" onclick="event.preventDefault(); approve()"> APPROVE </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var form = $('#pda_remarks_form');

        function approve() {
            var formData = form.serializeArray().reduce(function (obj, item){
                obj[item.name] = item.value;
                return obj;
            }, {});

            submitData(formData,'/agency/approve')
        }

        function disapprove() {
            var formData = form.serializeArray().reduce(function (obj, item){
                obj[item.name] = item.value;
                return obj;
            }, {});

            submitData(formData,'/agency/disapprove')
        }

        function submitData(data, formUrl) {
            axios.post('{{ url('/') }}' + formUrl, data)
                .then(function (response) {
                    console.log(response.data)
                    window.location.reload();
                })
                .catch(function (response) {
                    console.log(response.data);
                });
        }

        var vessel = $('#vessel');
        vessel.on('submit', function (e) {
            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            axios.post('{{ url('/vessel-details') }}', data)
                .then(function (response) {
                    var details = response.data.success;
                    $('#port').empty().append("<b>Port : </b> " + details.port);
                    $('#loa').empty().append("<b>LOA : </b> " + details.loa + " M");
                    $('#grt').empty().append("<b>GRT : </b> " + details.grt + " GT");
                    $('#vessel_name').empty().append("<b>Vessel : </b>" + details.vessel_name);
                    $('#vessel').empty().append("<h4><b>Vessel Details Updated</b></h4>");
                })
                .catch(function (response) {
                    console.log(response.data);
                });
            e.preventDefault();
        });

        var data = {
            'grt' : '{{ $quotation->vessel->grt + $quotation->vessel->consignee_good }}',
            'loa' : '{{ $quotation->vessel->loa }}',
            '_token' : '{{ csrf_token() }}',
            'quotation' : '{{ $quotation->id }}',
            'port_stay' : '{{ceil($quotation->vessel->grt/$quotation->discharge_rate)}}',
            'service': {}
        };

        function addTariff() {
            var selected = document.getElementById("tariff");
            var selectedTariff = JSON.parse(selected.options[selected.selectedIndex].value);
            var units = $('#service_units').val();

//            Calculation using grt/loa
            if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT }}'){

                var  grt_loa = Math.ceil(parseFloat(this.data.grt) / parseFloat(selectedTariff.unit_value));
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA }}'){
                var  grt_loa = Math.ceil(parseFloat(this.data.loa) / parseFloat(selectedTariff.unit_value));
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM }}'){
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY }}'){
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))
                }

                addService(serviceData);
            }
            else {
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))
                }

                addService(serviceData);
            }

        }

        function addService(data){
            $('#service').append('<tr id="' + data.id + '">' +
                '<td>' + data.description + '</td>' +
                '<td class="text-right">' + data.grt_loa + '</td>' +
                '<td class="text-right">' + Number(data.rate).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(data.units).toFixed(2) + '</td>' +
                '<td class="text-right"> </td>' +
                '<td class="text-right">' + Number(data.total).toFixed(2)+ '</td>' +
                '<td class="text-right"><button onclick="deleteRow(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.service[data.id] = data;
        }

        function deleteRow(row) {
            var table_row = row.parentNode.parentNode;

            delete this.data.service[table_row.id];
            table_row.parentNode.removeChild(table_row);
        }

        function addServiceToQuotaion() {
            if(Object.keys(this.data.service).length < 1){
                alert('No Service Added');
            }
            else {
                axios.post('{{ url('/quotation-service') }}', this.data)
                    .then(function (response) {
//                       TODO::validation
                        $('#q_service').empty().append(response.data.success.services);
                        $('#sub_ex').empty().append("Total (Excl) $ : " + response.data.success.total);
                        $('#total_tax').empty().append(response.data.success.total_tax);
                        $('#sub_in').empty().append("Total (Incl) $ : " + response.data.success.total);
                        $('#total_amount').empty().append("<b>Total (Incl) $ :</b>  " + response.data.success.total);
                        $('#service').empty();
                        this.data['service'] = {};
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
        }

        function perday(selected) {

            if(JSON.parse($('#'+selected.id).val()).unit_type === 'per day'){
                $('#service_units').val(this.data.port_stay);
            }
        }

        function deleteService(id) {
            axios.post('{{ url('/quotation-service-delete') }}', {
                'service_id' : id,
                'quotation_id' : this.data.quotation,
                '_token' : '{{ csrf_token() }}'
            })
                .then(function (response) {
//                       TODO::validation
                    $('#q_service').empty().append(response.data.success.services);
                    $('#sub_ex').empty().append("Total (Excl) $ : " + response.data.success.total);
                    $('#total_tax').empty().append(response.data.success.total_tax);
                    $('#sub_in').empty().append("Total (Incl) $ : " + response.data.success.total);
                    $('#total_amount').empty().append("<b>Total (Incl) $ :</b>  " + response.data.success.total);
                    $('#service').empty();
                    this.data['service'] = {};
                })
                .catch(function (response) {
                    console.log(response);
                });
        }

    </script>
@endsection