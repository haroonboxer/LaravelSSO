@extends('layouts.master')

@section('header')
<b>{{ trans('word.users') }}</b>
@endsection
@section('button')
@can('Add Users')
<button type="button" class="btn btn-light-primary font-weight-bolder" data-toggle="modal"
    data-target="#add_modal">{{ trans('word.add_user') }}
</button>
@endcan
@endsection
@section('content')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />

<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center  font-wight-bolder bg-dark text-light">
                <h4><b>{{ trans('word.add_user_title') }}</b></h4>
            </div>
            <div class="modal-body">
                <form id="store_form" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="name" class="col-form-label required">
                                {{ trans('word.name_and_surname') }}</label>
                            <input id="name" type="text" class="form-control" required name="name"
                                placeholder="{{ trans('word.name_and_surname') }}" autocomplete="off" autofocus>
                            <div class="invalid-feedback name_error"></div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="email" class="col-form-label required">{{ trans('word.email') }}</label>
                            <input id="email" type="email" class="form-control" required name="email"
                                autocomplete="off">
                            <div class="invalid-feedback email_error"></div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="password" class="col-form-label required">{{ trans('word.password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="off">
                            <div class="invalid-feedback password_error"></div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="password-confirm" class="col-form-label required">
                                {{ trans('word.confirm_password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="off">
                            <div class="invalid-feedback password_confirmation_error"></div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="roles" class="required">{{ trans('word.permissions') }}</label>
                            <select class="form-control select2" name="roles" id="roles" required>
                                <option value="" style="direction: ltr !important;" disabled selected>--
                                    {{ trans('word.select_permissions') }}--
                                </option>
                                @foreach ($roles as $item)
                                <option value="{{ $item->name }}" style="direction: ltr !important;">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-danger" type="button" data-dismiss="modal"
                            aria-label="Close">{{ trans('word.cancel_btn') }}</button>
                        <button type="submit" id="submitBtn"
                            class="btn btn-primary">{{ trans('word.keep_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <table class="table table-bordered table-hover table-checkable data-table" id="kt_datatable"
            style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>{{ trans('word.number') }}</th>
                    <th>{{ trans('word.name') }}</th>
                    <th>{{ trans('word.email') }}</th>
                    <th>{{ trans('word.permission') }}</th>
                    <th>{{ trans('word.status') }}</th>
                    <th class="text-center">{{ trans('word.action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center  font-wight-bolder bg-dark text-light">
                <h5><b>تجدید معلومات کاربر</b></h5>
            </div>
            <div class="modal-body">
                <form id="edit_form" method="POST" action="{{ route('users.update') }}">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="edit_name" class="col-form-label required">
                                {{ trans('word.name_and_surname') }} </label>
                            <input id="edit_name" type="text" class="form-control" required name="edit_name"
                                autocomplete="off" autofocus>
                            <div class="invalid-feedback edit_name_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_email" class="col-form-label required">{{ trans('word.email') }}</label>
                            <input id="edit_email" type="email" class="form-control" required name="edit_email"
                                autocomplete="off">
                            <div class="invalid-feedback edit_email_error"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="edit_roles"
                                class="col-form-label required">{{ trans('word.permissions') }}</label>
                            <select class="form-control select2" name="edit_roles" id="edit_roles" required>
                                <option value="" style="direction: ltr !important;" disabled selected>--
                                    {{ trans('word.select_permissions') }}--
                                </option>
                                @foreach ($roles as $item)
                                <option value="{{ $item->name }}" style="direction: ltr !important;">
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-danger" type="button" data-dismiss="modal"
                            aria-label="Close">{{ trans('word.keep_btn') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('word.close_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>{{ trans('word.update_user_password') }}</h5>
            </div>
            <div class="modal-body">
                <form id="change_password_form" autocomplete="off">
                    @csrf
                    <input type="hidden" name="password_user_id" id="password_user_id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password" class="col-form-label"> {{ trans('word.new_password') }}</label>
                            <input id="password" type="password" class="form-control" required name="password"
                                autofocus>
                            <div class="invalid-feedback password_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="col-form-label">
                                {{ trans('word.repeate_password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" required
                                name="password_confirmation">
                            <div class="invalid-feedback password_confirmation_error"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-danger" type="button" data-dismiss="modal"
                            aria-label="Close">{{ trans('word.cancel_btn') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('word.keep_btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#kt_datatable').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            "bInfo": false,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            // "aaSorting": [
            //     [0, "desc"]
            // ],
            "info": true,
            "language": {
                "sProcessing": 'لطفا منتظر باشد...<span class="spinner spinner-primary ml-10"></span>',
                "sSearch": "جستجو",
                "paginate": {
                    "previous": "قبلی",
                    "next": "بعدی"
                },
                "sEmptyTable": "دیتا موجود نیست"
            },
            ajax: "{{ route('users.index') }}",
            columns: [{
                    "data": 'id'
                },
                {
                    "data": 'name'
                },
                {
                    "data": 'email'
                },
                {
                    "data": 'role_name'
                },
                {
                    "data": 'status'
                },
                {
                    "data": 'action'
                }
            ]
        });

        var store_form_submited = false;
        $(document).on('submit', '#store_form', function(event) {
            event.preventDefault();

            if (!store_form_submited) {
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'html',
                    beforeSend: function() {
                        store_form_submited = true;
                        startModalLoader();
                    },
                    success: function(data) {
                        if (data == true) {
                            $('.data-table').DataTable().ajax.reload();
                            $("input[name=name]").val('');
                            $("input[name=email]").val('');
                            $("input[name=password]").val('');
                            $("input[name=password_confirmation]").val('');
                            $("select[name=section").val('').change;
                            $('#section_result').hide();
                            $('#store_form')[0].reset();
                            $('.select2').val(null).trigger('change');
                            $('#add_modal').modal('hide');
                            success("موفقانه ثبت گردید.!");
                        } else {
                            var response = JSON.parse(data);
                            $.each(response, function(prefix, val) {
                                $('div.' + prefix + '_error').text(val[0]);
                                $("input[name=" + prefix + "]").addClass(
                                    'is-invalid');
                                $("select[id=edit_" + prefix + "]").addClass(
                                    'is-invalid');
                            });
                        }
                        stopModalLoader();
                        store_form_submited = false;
                    },
                    error: function() {
                        error_function(
                            "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                        );
                        stopModalLoader();
                        store_form_submited = false;
                    }
                });
            }
        });

        var edit_form_submited = false;
        $(document).on('submit', '#edit_form', function(event) {
            event.preventDefault();

            if (!edit_form_submited) {
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'post',
                    data: $(this).serialize(),
                    // dataType: 'html',
                    beforeSend: function() {
                        edit_form_submited = true;
                        startModalLoader();
                    },
                    success: function(data) {
                        $('#edit_modal').modal('hide');
                        if (data == true) {
                            $('.data-table').DataTable().ajax.reload();
                            $("input[id=edit_password]").val('');
                            $("input[id=edit_password-confirm]").val('');
                            success("تغیرات موفقانه اجرا گردید.!");
                        } else if (data == 'duplicate_entry') {
                            $('div.email_error').text('این ایمیل قبلا ثبت شده است.');
                            $("input[id=edit_email]").addClass('is-invalid');
                        } else {
                            var response = JSON.parse(data);
                            $.each(response, function(prefix, val) {
                                $('div.' + prefix + '_error').text(val[0]);
                                $("input[id=edit_" + prefix + "]").addClass(
                                    'is-invalid');
                                $("select[id=edit_" + prefix + "]").addClass(
                                    'is-invalid');
                            });
                        }
                        stopModalLoader();
                        edit_form_submited = false;
                    },
                    error: function() {
                        error_function(
                            "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                        );
                        stopModalLoader();
                        edit_form_submited = false;
                    }
                });
            }
        });

        $(document).on('change', 'input', function(event) {
            $(this).removeClass('is-invalid');
        });

        $(document).on('click', '.edit_btn', function(event) {
            var id = $(this).attr('record_id');
            var section = $(this).attr('section');
            $('#edit_record_id').val(id);
            $('#edit_section').val(section).change();
            $('#edit_name').val($(this).attr('name'));
            $('#edit_email').val($(this).attr('email'));
            var action = $(this).attr('action');

            $.ajax({
                url: action,
                type: 'get',
                data: {
                    'section': section,
                    'id': id
                },
                // dataType:'html',
                beforeSend: function() {
                    $('body').css('padding-right', 'unset');
                    startModalLoader();
                },
                success: function(data) {
                    $('#edit_section_result').html(data);
                    $('#edit_section_result').show();
                    stopModalLoader();
                    $('body').css('padding-right', '17px');
                    $('#edit_modal').modal('show');
                    $('#roles_edit').select2();
                },
                error: function() {
                    error_function(
                        "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                    );
                    stopModalLoader();
                    $('body').css('padding-right', '17px');
                }
            });
        });

        $(document).on('change', '#system_id', function() {
            var value = $(this).val();
            if (value == '') {
                $('#main-form-permissions').html('');
                return false;
            }

            $.ajax({
                url: "{{ route('role.details', 'details') }}",
                type: 'get',
                data: {
                    'system_id': value
                },
                dataType: 'html',
                beforeSend: function() {
                    $('body').css('padding-right', 'unset');
                    startModalLoader();
                },
                success: function(data) {
                    $('#section_result').html(data);
                    $('#section_result').show();
                    $('#roles').select2({
                        width: '100%'
                    });
                    stopModalLoader();
                    $('body').css('padding-right', '17px');
                },
                error: function() {
                    error_function(
                        "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                    );
                    stopModalLoader();
                    $('body').css('padding-right', '17px');
                }
            });
        });

        $(document).on('change', '#edit_section', function() {
            var value = $(this).val();
            console.log('wwwwww');

            $.ajax({
                url: `{{ route('role.details', 'details') }}`,
                type: 'get',
                data: {
                    'section': value
                },
                dataType: 'html',
                beforeSend: function() {
                    $('body').css('padding-right', 'unset');
                    startModalLoader();
                },
                success: function(data) {
                    $('#edit_section_result').html(data);
                    $('#edit_section_result').show();
                    stopModalLoader();
                    $('body').css('padding-right', '17px');

                },
                error: function() {
                    error_function(
                        "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                    );
                    stopModalLoader();
                    $('body').css('padding-right', '17px');
                }
            });
        });
    });

    var user_id = '';

    function deActive(id) {
        user_id = id;
        Swal.fire({
            title: 'آیا میخواهید که حساب کاربر غیر فعال گردد؟',
            // text:'',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'بلی',
            cancelButtonColor: '#d33',
            cancelButtonText: 'نخیر',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ route('user.deactive') }}/` + user_id,
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            $('.data-table').DataTable().ajax.reload();
                            success(response.msg);
                        }
                    },
                    error: function() {
                        error_function(
                            "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                        );
                    }
                });
            }
        });
    }

    function active(id) {
        user_id = id;
        Swal.fire({
            title: 'آیا میخواهید که حساب کاربر فعال گردد؟',
            // text:'',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'بلی',
            cancelButtonColor: '#d33',
            cancelButtonText: 'نخیر',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ route('user.active') }}/` + user_id,
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            $('.data-table').DataTable().ajax.reload();
                            success(response.msg);
                        }
                    },
                    error: function() {
                        error_function(
                            "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                        );
                    }
                });
            }
        });
    }

    function getUserDataForUpdate(id) {
        $.ajax({
            url: `{{ route('users.edit') }}/` + id,
            type: 'GET',
            success: function(response) {
                if (response.status === true) {
                    $('#edit_name').val(response.data.name);
                    $('#user_id').val(response.data.id);
                    $('#edit_email').val(response.data.email);
                    $('#edit_roles').select2().val(response.role_name).change();

                    // for (var i = 0;i< response.role_name.lenght; i++) {
                    // }
                    $('#edit_modal').modal('show');
                }
            },
            error: function() {
                error_function(
                    "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                );
            }
        });
    }

    function changePassword(id) {
        $('#password_user_id').val(id);
        $('#change_password_modal').modal('show');
    }

    $('#change_password_form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: `{{ route('.changePassword') }`,
            type: 'post',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status == true) {
                    $('.data-table').DataTable().ajax.reload();
                    $('#change_password_modal').modal('hide');
                    success(response.data);
                } else {
                    $.each(response.errors, function(prefix, val) {
                        $('div.' + prefix + '_error').text(val[0]);
                        $("input[name=" + prefix + "]").addClass('is-invalid');
                    });
                }
            },
            error: function() {
                error_function(
                    "There Is Problem on Processing Your Request Please Contact Database Administrator!"
                );
            }
        });
    });

    setTimeout(() => {
        $('#edit_modal').modal('hide');
    }, 500);
</script>

<script>
    $("#store_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            },
            roles: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "اسم و تخلص را بنویسید",
            },
            email: {
                required: "ایمیل را بنویسید",
            },
            password: {
                required: "پسورد را بنویسید",
            },
            roles: {
                required: "انتخاب صلاحیت ضروری میباشد",
            },

        },
        errorPlacement: function(error, element) {
            // element.addClass('is-invalid');
            if (element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element);
            }
        },
    })
</script>
@endsection