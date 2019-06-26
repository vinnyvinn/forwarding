@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card card-body printableArea">
                <br>
                <div class="row">
                    @include('partials.quotation.invoice-head')
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>DESCRIPTION</th>
                                        <th class="text-right">QUANTITY</th>
                                        <th class="text-right">UNIT PRICE</th>
                                        <th class="text-right">TAX</th>
                                        <th class="text-right">TOTAL AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($quotation->services as $service)
                                        <tr id="{{$service->id}}">
                                            <td> {{ ucwords($service->name) }} </td>
                                            <td class="text-right">{{$service->total_units}} </td>
                                            <td class="text-right">{{ number_format($service->selling_price) }}</td>
                                            <td class="text-right">{{ number_format($service->tax, 2) }}</td>
                                            <td class="text-right">{{ number_format($service->total, 2) }}</td>
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
                                <h3 id="total_amount">Total (Excl) {{ $currency }} : {{ number_format(($quotation->services->sum('total') - $quotation->services->sum('tax')), 2) }}</h3>
                                <br>
                                <h4 style="margin-top: 4px !important; margin-bottom: 4px !important;" id="total_amount">Total Tax {{ $currency }} : {{ number_format($quotation->services->sum('tax'), 2) }}</h4>
                                <br>
                                <h3 id="total_amount"><b>Total (Incl) {{ $currency }} :</b> {{ number_format(($quotation->services->sum('total')), 2) }}</h3>
                            </div>
                            <hr>

                        </div>
                        <div>
                            <address id="client_details text-left">
                                <p>
                                    <br><b>Prepared by :</b> {{ ucwords($quotation->user->name)  }}</p>
                                <p><b>Checked by :</b> {{ $quotation->checkedBy == null ? '................................' : ucwords($quotation->checkedBy->name )}}</p>
                                <p><b>Approved by :</b> {{ $quotation->approvedBy == null ? '................................' : ucwords($quotation->approvedBy->name) }}</p>

                                <p><b>Date :</b> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
                                {{--<h4><b>Signed :</b> ...........................</h4>--}}
                            </address>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="text-left"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="text-left">
                                            <b>Account Name: &nbsp;&nbsp;&nbsp;&nbsp;</b> Freightwell Express Limited Nyali, Mombasa <br>
                                            <b>Bank:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> Ecobank Kenya Limited
                                            <br>
                                            <b>Account Detail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b> {{ $currency }} Account : {{ $currency == 'USD' ? '0251015023806101' : '0250015023806101'}}
                                            <br>
                                            <b>Swift Adrress: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ECOCKENA
                                        </h4>
                                        <h4 style="text-align: left !important;">PAYMENT TERMS: INVOICE DUE ON DEMAND <br>
                                            ANY OVERDUE AMOUNT WILL ATTRACT 3% INTEREST PER MONTH <br>ALL TRANSACTIONS ARE GOVERNED BY OUR STANDARD TRADING CONDITIONS AVAILABLE UPON REQUEST</h4></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Required Documents</h4>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-strpped">
                            <tr>
                                <th>Document Name</th>
                                <th>Description</th>
                                {{--<th class="text-right">Action</th>--}}
                            </tr>
                            <tbody>
                            @if($quotation->doc_ids != null)
                                @foreach(json_decode($quotation->doc_ids) as $docs)
                                    <tr>
                                        <td>{{ ucwords($docs->name) }}</td>
                                        <td>{{ ucfirst($docs->description) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED )
                        <form class="pda_remarks_form" action="" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="remarks">Comment</label>
                                <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">
                        </form>
                            @endif
                    </div>

                    <div class="col-sm-12 pull-right">
                        @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)
                            <button id="accept"  class="btn btn btn-primary">Accepted</button>
                            <button onclick="declined()" class="btn btn-danger"> Declined </button>
                        @endif
                        <button id="print" class="btn btn-success pull-right" type="button"> <span><i class="fa fa-print"></i> Print / Download</span> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var form = $('.pda_remarks_form');

        // function accept() {
        //
        //     var formData = $('#pda_remarks_form').serializeArray().reduce(function (obj, item){
        //         obj[item.name] = item.value;
        //         return obj;
        //     }, {});
        //
        //     submitData(formData,'/quotation/customer/accepted')
        // }

        $('#accept').on('click',function () {

          $.ajax({
              url:'{{url('/quotation/customer/accepted')}}',
              type:'POST',
              data:form.serialize(),
              success: function (response) {
                  window.location.reload();
              }
          })
        });

        function declined() {
            var formData = form.serializeArray().reduce(function (obj, item){
                obj[item.name] = item.value;
                return obj;
            }, {});

            submitData(formData,'/quotation/customer/declined')
        }

        function submitData(data, formUrl) {
            cssLoader();
            axios.post('{{ url('/') }}' + formUrl, data)
                .then(function (response) {

                    stopLoader();
                    window.location.reload();
                })
                .catch(function (response) {
                    console.log(response.data);
                });
        }
    </script>
@endsection
