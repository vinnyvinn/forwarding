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
                        <h4 class="card-title">Tariffs Services <a href="{{ route('tariffs.create') }}" class="btn btn-primary pull-right">Add Tariff</a></h4>
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
                                    <th>Name</th>
                                    <th>Tariff Type</th>
                                    <th>Tariff Unit Type</th>
                                    <th>Tariff Unit</th>
                                    <th>Tariff Unit Value</th>
                                    <th>Rate Per Unit</th>
                                    <th>Created On</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($tariffs as $tariff)
                                    <tr>
                                        <td>{{ ucwords($tariff->name) }}</td>
                                        <td>{{ ucfirst($tariff->type) }}</td>
                                        <td>{{ ucfirst($tariff->unit_type) }}</td>
                                        <td>{{ $tariff->unit }}</td>
                                        <td>{{ $tariff->unit_value }}</td>
                                        <td>{{ $tariff->rate }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tariff->created_at)->format('d-M-y') }}</td>
                                        <td class="text-nowrap">
                                            <form action="{{ route('tariffs.destroy', $tariff->id) }}" method="post">
{{--                                                <a href=" {{ route('leads.show', $tariff->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>--}}
                                                <a href=" {{ route('tariffs.edit', $tariff->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $tariffs->links() }}
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