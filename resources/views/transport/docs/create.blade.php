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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Required Docs</h4>
                        <form class="form-material m-t-40" action="{{ route('required-docs.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Document Name</label>
                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Document Name">
                                    </div>
                                </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" required id="description" name="description" class="form-control" placeholder="Description">
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="btn pull-right btn-primary" type="submit" value="Save">
                                </div>
                            </div>
                            {{--</div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

