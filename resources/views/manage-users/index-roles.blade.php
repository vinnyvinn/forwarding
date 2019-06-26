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
                    <div class="card-header">
                        <h4 class="card-title">Roles and Permissions <a href="{{ url('/create-role') }}" class="btn btn-primary pull-right">Add Role</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ ucwords($role->name) }}</td>
                                        <td>@foreach(json_decode($role->permissions) as $key => $permission)
                                                <b>{{ $loop->iteration }}.</b> {{ ucwords(str_replace('-',' ',$key)) }}
                                                @endforeach
                                        </td>
                                        <td class="text-right">
                                                <form action="{{ url('/delete-role/'. $role->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection