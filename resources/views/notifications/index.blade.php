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
                        <h4 class="card-title">Notifications</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Text</th>
                                    <th>View</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td>{{ ucwords($notification->title) }}</td>
                                        <td>{{ ucfirst($notification->text) }}</td>
                                        @if($notification->status == 0)
                                        <td><a href="{{ url('/notifications/'.$notification->id) }}" class="btn btn-sm"><i class="fa fa-eye"></i></a></td>
                                        @else
                                            <td><i class="fa fa-times-circle"></i></td>
                                        @endif
                                            <td>{{ $notification->status == 0 ? 'Unread' : 'Read' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection