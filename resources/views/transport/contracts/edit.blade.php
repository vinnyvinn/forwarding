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
                        <h4 class="card-title">Edit Contract</h4>
                        <form id="contact_form" class="m-t-40" action="{{ route('contracts.update', $contract->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" required id="company_name" value="{{ $contract->company_name }}" name="company_name" class="form-control" placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="contract_type">Contract Type</label>
                                        <select name="contract_type" id="contract_type" required class="form-control">
                                            <option value="">Select Contract Type</option>
                                            <option {{ $contract->contract_type == 'open' ? 'selected' : '' }} value="open">Open</option>
                                            <option {{ $contract->contract_type == 'per_km' ? 'selected' : '' }} value="per_km">Per Kilo Meter</option>
                                            <option {{ $contract->contract_type == 'per_wgt' ? 'selected' : '' }} value="per_wgt">Per Weight(Tonne)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="value">Charge</label>
                                        <input type="text" required id="value" name="value" value="{{ $contract->value }}" class="form-control" placeholder="Value">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="contact">Contact </label>
                                        <input type="text" id="contact" name="contact" value="{{ $contract->contact }}" class="form-control" placeholder="Contact">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address </label>
                                        <input type="text" id="address" name="address" value="{{ $contract->address }}" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks">Remarks </label>
                                        <input type="text" id="remarks" name="remarks" value="{{ $contract->remarks }}" class="form-control" placeholder="Remarks">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="body">Contract Body</label>
                                    <textarea name="body" required id="body" cols="30" rows="10" class="form-control">{{ $contract->body }}</textarea>
                                    <div class="form-group">
                                        <br>
                                        <input class="btn pull-right btn-primary" type="submit" value="Update">
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

            if(contractType.find(":selected").val() === 'open'){
                contractValue.val(0);
                contractValue.attr('readonly','readonly');
            }
            else {
                contractValue.val('');
                contractValue.removeAttr('readonly');
            }
        });

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

