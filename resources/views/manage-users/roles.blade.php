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
                <form action="{{ url('store-role') }}" method="post">
                    {{ csrf_field()}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles and Permissions</h4>
                            <h4>Add Role</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="form-group"><label for="name">Role Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Role Permissions</h4>
                            <div class="row">
                                @foreach($permissions as $key => $permission)
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <ul class="icheck-list">
                                                <input type="checkbox" name="permissions[{{$key}}]" class="check" id="{{$key}}">
                                                <label for="{{$key}}">{{ $permission }}</label>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary pull-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection