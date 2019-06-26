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
                        <h4 class="card-title">Users <a href="{{ route('manage-users.create') }}" class="btn btn-primary pull-right">Add User</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dtforall" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Title</th>
                                    <th>Created On</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ ucwords($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@foreach($user->roles as $role)
                                                {{ $loop->iteration }} {{ $role->name }}
                                                @endforeach
                                        </td>
                                        <td>{{ ucfirst($user->title) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-y') }}</td>
                                        <td class="text-right">
                                            @if($user->id != 1)
                                                <form action="{{ route('manage-users.destroy', $user->id) }}" method="post">
                                                    <a href=" {{ route('manage-users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    @can('can-delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                        @endcan
                                                </form>
                                            @endif
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