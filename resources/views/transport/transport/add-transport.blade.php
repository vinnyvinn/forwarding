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
                        <h4 class="card-title">Add Transport</h4>
                        <form id="contact_form" class="m-t-40" action="{{ url('/store-transport') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="driver_name">Driver Name</label>
                                        <input type="text" required id="driver_name" name="driver_name" class="form-control" placeholder="Driver Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="truck_no">Track Number</label>
                                        <input type="text" required id="truck_no" name="truck_no" class="form-control" placeholder="Track Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="container_reg">Container Number</label>
                                        <input type="text" required id="container_reg" name="container_reg" class="form-control" placeholder="Container Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="tonne">Tonne</label>
                                        <input type="text" required id="tonne" name="tonne" class="form-control" placeholder="Tonne">
                                    </div>
                                    <div class="form-group">
                                        <label for="feu">FEU</label>
                                        <input type="text"  id="feu" name="feu" class="form-control" placeholder="FEU">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lcl">LCL</label>
                                        <input type="text"  id="lcl" name="lcl" class="form-control" placeholder="LCL">
                                    </div>
                                    <div class="form-group">
                                        <label for="teu">TEU</label>
                                        <input type="text"  id="teu" name="teu" class="form-control" placeholder="TEU">
                                    </div>
                                    @if($transport->contracts->contract_type == 'rates')
                                        <div class="form-group"><label for="rates">Rates</label>
                                            <select name="rates" id="rates" onchange="changeBuying(this)" class="form-control">
                                                @foreach($transport->contracts->slubs as $slub)
                                                    <option value="{{$slub}}">{{ $slub->from }} - {{ $slub->to }} @ {{ $slub->charges }} USD in {{ $slub->t_round }} days</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buying">Buying </label>
                                            <input type="text" id="buying" name="buying" readonly class="form-control" placeholder="Buying">
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="buying">Buying </label>
                                            <input type="text" id="buying" name="buying" value="{{ $transport->contracts->contract_type == 'open' ? $transport->contracts->value :
                                                        ($transport->contracts->contract_type == 'per_wgt' ? ($transport->contracts->value * $transport->cargo_weight) : ($transport->contracts->value * $transport->distance))}}" readonly class="form-control" placeholder="Buying">
                                        </div>
                                    @endif

                                        <input type="hidden" id="bill_of_landing_id" value="{{$transport->id}}" name="bill_of_landing_id" class="form-control" >
                                    <div class="form-group">
                                        <label for="cost">Selling </label>
                                        <input type="text" required id="cost" name="cost" class="form-control" placeholder="Cost">
                                    </div>
                                    <div class="form-group">
                                        <label for="depart">Departure Date </label>
                                        <input type="datetime-local" required id="depart" name="depart" class="form-control" placeholder="Departure Date">
                                    </div>
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

        function changeBuying(data) {
            var buyingValue = $('#buying');
            var selected = document.getElementById("rates")
            var getSelectedService = JSON.parse(selected.options[selected.selectedIndex].value);

            buyingValue.val(getSelectedService.charges);
            console.log(getSelectedService);
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

