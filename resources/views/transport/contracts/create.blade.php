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
       
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Contract</h4>
                        <form id="contact_form" class="m-t-40" action="{{ route('contracts.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" required id="company_name" name="company_name" class="form-control" placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="contract_type">Contract Type</label>
                                                <select name="contract_type" id="contract_type" required class="form-control">
                                                    <option value="">Select Contract Type</option>
                                                    <option value="open">Open</option>
                                                    <option value="per_km">Per Kilo Meter</option>
                                                    <option value="per_wgt">Per Weight(Tonne)</option>
                                                    <option value="rates">Rates</option>
                                                </select>
                                    </div>
                                <div class="form-group">
                                    <label for="value">Charge</label>
                                    <input type="text" required id="value" name="value" class="form-control" placeholder="Value">
                                </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="contact">Contact </label>
                                        <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address </label>
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks">Remarks </label>
                                        <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Remarks">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row" id="col_rate">

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="body">Contract Body</label>
                                    <textarea name="body" required id="body" cols="30" rows="10" class="form-control"></textarea>
                                    <div class="form-group">
                                        <br>
                                        <input class="btn pull-right btn-primary" type="submit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var contractType = $('#contract_type');
        contractType.on('change', function () {
            var contractValue = $('#value');
            if(contractType.find(":selected").val() === 'rates'){
                $('#col_rate').append('<div class=" col-sm-3 form-group">' +
                    '                                            <input type="text" id="from" required name="from[]" class="form-control" placeholder="From">' +
                    '                                        </div>' +
                    '                                        <div class=" col-sm-3 form-group">' +
                    '                                            <input type="text" id="to" required name="to[]" class="form-control" placeholder="Destination">' +
                    '                                        </div>' +
                    '                                        <div class=" col-sm-3 form-group">' +
                    '                                            <input type="text" id="t_round" required name="t_round[]" class="form-control" placeholder="Turn Around Time">' +
                    '                                        </div>' +
                    '                                        <div class=" col-sm-2 form-group">' +
                    '                                            <input type="number" id="charges" required name="charges[]" class="form-control" placeholder="Charges">' +
                    '                                        </div>' +
                    '<div class="col-sm-1">' +
                    '<button type="button" onclick="addColRate()" class="btn btn-primary pull-right btn-sm"><i class="fa fa-plus"></i></button>' +
                    '                                        </div>');

                contractValue.val('');
                contractValue.attr('readonly','readonly');
            }
            else {
                contractValue.val('');
                $('#col_rate').empty();
                contractValue.removeAttr('readonly');
            }
        });

        function addColRate() {
            $('#col_rate').append('<div class=" col-sm-3 form-group">' +
                '                                            <input type="text" id="from" required name="from[]" class="form-control" placeholder="From">' +
                '                                        </div>' +
                '                                        <div class=" col-sm-3 form-group">' +
                '                                            <input type="text" id="to" required name="to[]" class="form-control" placeholder="Destination">' +
                '                                        </div>' +
                '                                        <div class=" col-sm-3 form-group">' +
                '                                            <input type="text" id="t_round" required name="t_round[]" class="form-control" placeholder="Turn Around Time">' +
                '                                        </div>' +
                '                                        <div class=" col-sm-3 form-group">' +
                '                                            <input type="number" id="charges" required name="charges[]" class="form-control" placeholder="Charges">' +
                '                                        </div>');
        }

        {{--function contractForm(form) {--}}
            {{--var form_id = form.id;--}}
            {{--var contractForm = $('#' + form_id);--}}

            {{--var data = contractForm.serializeArray().reduce(function(obj, item) {--}}
                {{--obj[item.name] = item.value;--}}
                {{--return obj;--}}
            {{--}, {});--}}

            {{--axios.post('{{ route('contracts.store') }}', data)--}}
                {{--.then( function (response) {--}}

                {{--})--}}
                {{--.catch( function (response) {--}}

                {{--})--}}
        {{--}--}}
    </script>
@endsection

