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
                    < class="card-body">
                        <h4 class="card-title">Choose period</h4>
                        <form class="form-material m-t-40" action="{{ url('get-leads') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="from">Date From</label>
                                        <input type="text" required id="from" name="from" class="form-control date_range" placeholder="from">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="to">Date To</label>
                                        <input type="text" id="to" name="to" class="form-control date_range" placeholder="to date">


                                    </div>
                                </div>
                                <div class="form-group text-center">
                                  <input class="btn  btn-primary" type="submit" value="Fetch">
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
        $('.date_range').datepicker();

    </script>
@endsection


