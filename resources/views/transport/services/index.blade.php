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
                    <div class="card-header">
                        <h4 class="card-title">Services <a href="{{ route('services.create') }}" class="btn btn-primary pull-right">Add Service</a></h4>
                    </div>
                    <div class="card-body">
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--Search : <input type="text" id="search_lead">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Service Type</th>
                                    <th>Service Unit</th>
                                    <th>Rate Per Unit</th>
                                    <th>Created On</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($services as $service)
                                    <tr>
                                        <td>{{ ucwords($service->name) }}</td>
                                        <td>{{ ucfirst($service->type) }}</td>
                                        <td>{{ $service->unit }}</td>
                                        <td>{{ $service->rate }}</td>

                                        <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d-M-y') }}</td>
                                        <td class="text-nowrap">
                                            <form action="{{ route('services.destroy', $service->id) }}" method="post">
{{--                                                <a href=" {{ route('leads.show', $tariff->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>--}}
                                                <a href=" {{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                @can('can-delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $services->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var customer = $('#search_lead');

        customer.on('keyup', function () {
            axios.post('{{ url('/search-lead') }}',{
                'search_item': customer.val()
            }).then( function (response) {
                $('#customers').empty().append(response.data.output);
            })
                .catch( function (error) {
                    console.log(error)
                });
        });
    </script>
@endsection