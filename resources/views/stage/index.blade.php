@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Stages</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Stages</li>
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
                        <h4 class="card-title">All Stages <a href="{{ route('stages.create') }}" class="btn btn-primary pull-right">Add Stages</a></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dtforall" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($stages as $stage)
                                    <tr>
                                        <td>{{ ucwords($stage->name) }}</td>
                                        <td>{{ ucwords($stage->type) }}</td>
                                        <td>{{ ucfirst($stage->description) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($stage->created_at)->format('d-M-y') }}</td>
                                        <td >
                                            <form action="{{ route('stages.destroy', $stage->id) }}" method="post">
                                                <a href=" {{ route('stages.edit', $stage->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href=" {{ route('stages.show', $stage->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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