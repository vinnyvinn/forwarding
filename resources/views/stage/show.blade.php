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
                        <h4 class="card-title">{{ ucwords($stage->name)}} CheckList
                            <button class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-boarded">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Required</th>
                                <th>Notification</th>
                                <th>Time</th>
                                <th>components</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="components">
                            @foreach($components as $item)
                                <tr>
                                    <td>{{ ucwords($item->name) }}</td>
                                    <td>{{ ucfirst($item->description) }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->required == true ? 'Yes' : 'No' }}</td>
                                    <td>{{ $item->notification == true ? 'Yes' : 'No' }}</td>
                                    <td>{{ $item->timing }} Mins</td>
                                    <td>{{ ($item->components != null ? implode(",",json_decode($item->components)) : $item->components ) }}</td>
                                    <td>
                                        <form action="{{ route('stage-components.destroy', $item->id) }}" method="post">
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
    <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add CheckList</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                                <form id="checklist" action="{{ route('stage-components.store') }}" onsubmit="event.preventDefault(); addChecklist(this, '{{ route('stage-components.store') }}')" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="hidden" value="{{ $stage->id }}" name="stage_id" id="stage_id">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text"  required id="name" name="name" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="file">File</option>
                                                            <option value="text">Text</option>
                                                            <option value="checkbox">Checkbox</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="required">Required</label>
                                                        <select name="required" id="required" class="form-control">
                                                            <option value="true">Yes</option>
                                                            <option value="false">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="notification">Send Notification</label>
                                                        <select name="notification" id="notification" class="form-control">
                                                            <option value="true">Yes</option>
                                                            <option value="false">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="timing">Time (minutes)</label>
                                                        <input type="text"  required id="timing" name="timing" class="form-control" placeholder="Time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text"  required id="description" name="description" class="form-control" placeholder="Description">
                                            </div>
                                            <div class="form-group">
                                                <label for="components">Sub Check List</label>
                                                <textarea name="components" id="components" cols="30" rows="3"
                                                          class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-block btn-primary" type="submit" value="Save">
                                            </div>

                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('scripts')
    <script>
        function addChecklist(form, formUrl){

            var formId = form.id;
            var vessel = $('#'+formId);

            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            axios.post(formUrl, data)
                .then(function (response) {
                    var details = response.data.success;

                    $('#components').append(details);
                    $('#modal').modal('hide');

                })
                .catch(function (response) {
                    console.log(response.data);
                });

        }
    </script>
@endsection