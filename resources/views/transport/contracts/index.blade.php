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
                        <h4 class="card-title">Contracts <a href="{{ route('contracts.create') }}" class="btn btn-primary pull-right">Add Contract</a></h4>
                    </div>
                    <div class="card-body">
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact</th>
                                    <th>Contract Type</th>
                                    <th>Charge</th>
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($contracts as $contract)
                                    <tr>
                                        <td>{{ ucwords($contract->company_name) }}</td>
                                        <td>{{ ucfirst($contract->contact) }}</td>
                                        <td>{{ $contract->contract_type == 'open' ||
                                        $contract->contract_type == 'rates' ? ($contract->contract_type ==
                                        'open' ? 'Open' : 'Rates') : ($contract->contract_type == 'per_km' ?
                                         'Per Kilo Meter' : 'Per Tonne') }}</td>
                                        <td>
                                            @if($contract->contract_type == 'rates')
                                                @foreach($contract->slubs as $slub)
                                                    {{ $slub->from. ' - '. $slub->to }} USD {{ $slub->charges }} <br>
                                                @endforeach
                                                @else
                                                {{ $contract->contract_type == 'open' ? $contract->value : $contract->value }}
                                                @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($contract->created_at)->format('d-M-y') }}</td>
                                        <td class="text-nowrap">
                                            <form action="{{ route('contracts.destroy', $contract->id) }}" method="post">
                                                <a href=" {{ route('contracts.show', $contract->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                <a href=" {{ route('contracts.edit', $contract->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
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
                                {{ $contracts->links() }}
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