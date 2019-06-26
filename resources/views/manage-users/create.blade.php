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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add User</h4>
                        <form class="form-material m-t-40 manage-users" action="{{ route('manage-users.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" required id="email" name="email" class="form-control" placeholder=" Email">
                                    </div>
                                </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" required id="title" name="title" class="form-control" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Select Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{ucwords($role->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" required id="password" name="password" class="form-control" placeholder="Password">
                                       <span class="pass_placeholder"></span>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input class="btn pull-right btn-primary btnClick" type="submit" value="Save">
                                </div>
                            </div>
                            {{--</div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function () {
            var validated;
            $('#password').on('keyup', function () {
                $(this).each(function () {
                    validated = true;
                    if (this.value.length < 8)
                        validated = false;
                    if (!/\d/.test(this.value))
                        validated = false;
                    if (!/[a-z]/.test(this.value))
                        validated = false;
                    if (!/[A-Z]/.test(this.value))
                        validated = false;
                    if (/[^0-9a-zA-Z!@#$%^&*()]/.test(this.value))
                        validated = false;
                    if (!validated) {
                        $('.pass_placeholder').css('color', 'red').text('Password must contain atleast 1 digit,1 lowercase character,1 uppercase character and must not be less than 8 characters.');

                    } else {
                        $('.pass_placeholder').css('color', 'green').text('Password strength passed');
                    }


                });
            });


            $('.manage-users').on('submit', function (e) {
                e.preventDefault();

                $('.btnClick').attr('disabled', true).val('Please wait');
                if (validated) {
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function (response) {
                            console.log(response);
                            window.location.href = '{{url('manage-users')}}';
                        }
                    });
                }
                else{
                    $('.pass_placeholder').css('color', 'red').text('Password must contain atleast 1 digit,1 lowercase character,1 uppercase character and must not be less than 8 characters.');
                    $('.btnClick').attr('disabled', false).val('Save');
                    return true;
                }

            })


        })

    </script>

@endsection


