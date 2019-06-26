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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Tariff</h4>
                        <form class="form-material m-t-40" action="{{ route('tariffs.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">Tariff Type</label>
                                        <select name="type" required id="type" class="form-control">
                                            <option value="">Select Tariff Type</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_INTERNAL }}">Internal</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_KPA }}">KPA</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Service Name </label>
                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_type">Tariff GRT/LOA</label>
                                        <select name="unit_type" required id="unit_type" class="form-control">
                                            <option value="">Select Tariff Type</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM }}">Lumpsum</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT }}">GRT</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA }}">LOA</option>
                                            <option value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY }}">Per Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="unit">Tariff Unit</label>
                                        <input type="text" required id="unit" name="unit" class="form-control" placeholder="Tariff Unit">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_value">Tariff Unit Value</label>
                                        <input type="number" min="1" required id="unit_value" name="unit_value" class="form-control" placeholder="Tariff Unit Value">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Rate Per Unit </label>
                                        <input type="text" required id="rate" name="rate" class="form-control" placeholder="Rate Per Unit">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn pull-right btn-primary">Add Tariff</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

