@extends('admin.layouts.master')

@section('content')
    <!-- Team Start -->
    <div class="container-xxl py-5">
        @if (session('message'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        </head>

        <body>
            <div class="container">
                <br />
                <div align="right">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create
                        Record</button>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="user_table">
                        <thead>
                            <tr>
                                <th width="10%">Image</th>
                                <th>item_name</th>
                                <th>item_university</th>
                                <th>poster_name</th>
                                <th>poster_email</th>
                                <th>poster_phone</th>
                                <th>price</th>
                                <th width="30%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <br />
                <br />
            </div>
        </body>

        </html>

        <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Record</h4>
                    </div>
                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="form-group">
                                <label class="control-label col-md-4">Item Name : </label>
                                <div class="col-md-8">
                                    <input type="text" name="item_name" id="item_name" class="form-control" />
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label for="item_name" class="col-sm-2 control-label">item name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="item_name" name="item_name"
                                        placeholder="Enter item name" value="" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="item_university" class="col-sm-2 control-label">item university</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="item_university"
                                        name="item_university" placeholder="Enter item university" value=""
                                        maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="poster_name" class="col-sm-2 control-label">poster name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="poster_name" name="poster_name"
                                        placeholder="Enter poster name" value="" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="poster_email" class="col-sm-2 control-label">poster email</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="poster_email" name="poster_email"
                                        placeholder="Enter poster email" value="" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="poster_phone" class="col-sm-2 control-label">poster phone</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="poster_phone" name="poster_phone"
                                        placeholder="Enter poster phone" value="" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">price</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter price" value="" maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Profile Image : </label>
                                <div class="col-md-8">
                                    <input type="file" name="image" id="image" />
                                    <span id="store_image"></span>
                                </div>
                            </div>
                            <br />
                            <div class="form-group" align="center">
                                <input type="hidden" name="action" id="action" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                    value="Add" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                        <h2 class="modal-title">Confirmation</h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {

                $('#user_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('goods.index') }}",
                    },
                    columns: [{
                            data: 'image',
                            name: 'image',
                            render: function(data, type, full, meta) {
                                return "<img src={{ URL::to('/') }}/images/" + data +
                                    " width='70' class='img-thumbnail' />";
                            },
                            orderable: false
                        },
                        {
                            data: 'item_name',
                            name: 'item_name'
                        },
                        {
                            data: 'item_university',
                            name: 'item_university'
                        },
                        {
                            data: 'poster_name',
                            name: 'poster_name'
                        },
                        {
                            data: 'poster_email',
                            name: 'poster_email'
                        },
                        {
                            data: 'poster_phone',
                            name: 'poster_phone'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        }
                    ]
                });

                $('#create_record').click(function() {
                    $('.modal-title').text("Add New Record");
                    $('#action_button').val("Add");
                    $('#action').val("Add");
                    $('#formModal').modal('show');
                });

                $('#sample_form').on('submit', function(event) {
                    event.preventDefault();
                    if ($('#action').val() == 'Add') {
                        $.ajax({
                            url: "{{ route('goods.store') }}",
                            method: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                var html = '';
                                if (data.errors) {
                                    html = '<div class="alert alert-danger">';
                                    for (var count = 0; count < data.errors.length; count++) {
                                        html += '<p>' + data.errors[count] + '</p>';
                                    }
                                    html += '</div>';
                                }
                                if (data.success) {
                                    html = '<div class="alert alert-success">' + data.success +
                                        '</div>';
                                    $('#sample_form')[0].reset();
                                    $('#user_table').DataTable().ajax.reload();
                                }
                                $('#form_result').html(html);
                            }
                        })
                    }

                    if ($('#action').val() == "Edit") {
                        $.ajax({
                            url: "goods/update" + id,
                            method: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                var html = '';
                                if (data.errors) {
                                    html = '<div class="alert alert-danger">';
                                    for (var count = 0; count < data.errors.length; count++) {
                                        html += '<p>' + data.errors[count] + '</p>';
                                    }
                                    html += '</div>';
                                }
                                if (data.success) {
                                    html = '<div class="alert alert-success">' + data.success +
                                        '</div>';
                                    $('#sample_form')[0].reset();
                                    $('#store_image').html('');
                                    $('#user_table').DataTable().ajax.reload();
                                }
                                $('#form_result').html(html);
                            }
                        });
                    }
                });

                $(document).on('click', '.edit', function() {
                    var id = $(this).attr('id');
                    $('#form_result').html('');
                    $.ajax({
                        url: "goods.update" + id + "/edit",
                        dataType: "json",
                        success: function(html) {
                            $('#first_name').val(html.data.first_name);
                            $('#last_name').val(html.data.last_name);
                            $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html
                                .data.image + " width='70' class='img-thumbnail' />");
                            $('#store_image').append(
                                "<input type='hidden' name='hidden_image' value='" + html.data
                                .image + "' />");
                            $('#hidden_id').val(html.data.id);
                            $('.modal-title').text("Edit New Record");
                            $('#action_button').val("Edit");
                            $('#action').val("Edit");
                            $('#formModal').modal('show');
                        }
                    })
                });

                var user_id;

                $(document).on('click', '.delete', function() {
                    user_id = $(this).attr('id');
                    $('#confirmModal').modal('show');
                });

                $('#ok_button').click(function() {
                    $.ajax({
                        url:"goods/destroy/"+user_id, 
                        beforeSend: function() { 
                            $('#ok_button').text('Deleting...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('#confirmModal').modal('hide');
                                $('#user_table').DataTable().ajax.reload();
                            }, 2000);
                        }
                    })
                });

            });
        </script>

    </div>
@endsection
