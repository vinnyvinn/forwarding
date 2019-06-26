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
                        <h4 class="card-title">Edit Service {{ $service->id }}</h4>
                        <form class="form-material m-t-40" action="{{ route('services.update', $service->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">Service Type</label>
                                        <select name="type" required id="type" class="form-control">
                                            <option value="">Select Service Type</option>
                                            <option value="All">All Service Type</option>
                                            <option value="kpa">KPA Charges</option>
                                            <option value="{{ \Esl\helpers\Constants::TRANSPORT_IMPORT }}">Import</option>
                                            <option value="{{ \Esl\helpers\Constants::TRANSPORT_EXPORT }}">Export</option>
                                            {{--                                            <option value="{{ \Esl\helpers\Constants::TRANSPORT_CLEARING }}">Clearing</option>--}}
                                            {{--                                            <option value="{{ \Esl\helpers\Constants::TRANSPORT_ALL }}">General</option>--}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Service Name </label>
                                        <input type="text" value="{{ $service->name }}" required id="name" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="unit">Service Unit</label>
                                        <input type="text" value="{{ $service->unit }}" required id="unit" name="unit" class="form-control" placeholder="Service Unit">
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Rate Per Unit </label>
                                        <input type="text" value="{{ $service->rate }}" required id="rate" name="rate" class="form-control" placeholder="Rate Per Unit">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn pull-right btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

