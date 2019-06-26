<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jobs Reports</h4>

                </div>
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-striped tbl-agency" id="customers">
                            <thead>
                            <tr>
                                <th>Project Code</th>
                                <th>Customer</th>
                                <th>Telephone</th>
                                <th>BL/SO NO</th>
                                <th>Created</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{$job->file_number}}</td>
                                    <td>{{ $job->customer ? ucwords($job->customer->Name) :''}}</td>
                                    <td>{{ $job->customer ? $job->customer->Telephone :''}}</td>
                                    <td>{{$job->bl_number}}</td>
                                    <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d-M-y') }}</td>
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

