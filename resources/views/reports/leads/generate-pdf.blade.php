<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Leads Reports</h4>
                    {{--<h4 class="card-title">Leads <a href="{{ route('leads.create') }}" class="btn btn-primary pull-right">Add Lead</a></h4>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped tbl-agency" id="customers">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Currency</th>
                                <th>Created</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{ ucwords($lead->name) }}</td>
                                    <td>{{ ucfirst($lead->contact_person) }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->currency}}</td>
                                    <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d-M-y') }}</td>
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
<style>

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;

        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
