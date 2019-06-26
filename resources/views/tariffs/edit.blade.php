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
                        <h4 class="card-title">Edit Tariff</h4>
                        <form class="form-material m-t-40" action="{{ route('tariffs.update', $tariff->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">Tariff Type</label>
                                        <select name="type" required id="type" class="form-control">
                                            <option value="">Select Tariff Type</option>
                                            <option {{ $tariff->type == \Esl\helpers\Constants::TARIFF_INTERNAL ? 'selected' : '' }}value="{{ \Esl\helpers\Constants::TARIFF_INTERNAL }}">Internal</option>
                                            <option {{ $tariff->type == \Esl\helpers\Constants::TARIFF_KPA ? 'selected' : '' }}value="{{ \Esl\helpers\Constants::TARIFF_KPA }}">KPA</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Service Name </label>
                                        <input type="text" required id="name" name="name" value="{{ $tariff->name }}" class="form-control" placeholder="Name">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_type">Tariff Unit Type</label>
                                        <select name="unit_type" required id="unit_type" class="form-control">
                                            <option value="">Select Tariff Type</option>
                                            <option {{ $tariff->unit_type == \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM  ? 'selected' : '' }} value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM }}">Lumpsum</option>
                                            <option {{ $tariff->unit_type == \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT ? 'selected' : '' }} value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT }}">GRT</option>
                                            <option {{ $tariff->unit_type == \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA ? 'selected' : '' }} value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA }}">LOA</option>
                                            <option {{ $tariff->unit_type == \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY ? 'selected' : '' }}  value="{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY }}">Per Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="unit">Tariff Unit</label>
                                        <input type="text" required id="unit" name="unit" value="{{ $tariff->unit }}" class="form-control" placeholder="Tariff Unit">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_value">Tariff Unit Value</label>
                                        <input type="number" min="1" required id="unit_value"  value="{{ $tariff->unit_value }}"  name="unit_value" class="form-control" placeholder="Tariff Unit Value">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="rate">Rate Per Unit </label>
                                        <input type="text" required id="rate" name="rate" value="{{ $tariff->rate }}"  class="form-control" placeholder="Rate Per Unit">
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

