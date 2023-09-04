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

        <!DOCTYPE html>
        <html>

        <head>
            {{-- <title>Laravel Ajax CRUD Tutorial Example - ItSolutionStuff.com</title> --}}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
            <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
            <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        </head>

        <body>
            <div class="container">
                {{-- <h1>Laravel Ajax CRUD Tutorial Example - ItSolutionStuff.com</h1> --}}
                <a class="btn btn-success my-3" href="javascript:void(0)" id="createNewProduct"> Create New Item</a>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>item_name</th>
                            <th>item_university</th>
                            <th>poster_name</th>
                            <th>poster_email</th>
                            <th>poster_phone</th>
                            <th>price</th>


                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="ajaxModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="productForm" name="productForm" class="form-horizontal">
                                <input type="hidden" name="good_id" id="good_id">
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



                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                        Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </body>

        <script type="text/javascript">
            $(function() {

                /*------------------------------------------
                 --------------------------------------------
                 Pass Header Token
                 --------------------------------------------
                 --------------------------------------------*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                /*------------------------------------------
                --------------------------------------------
                Render DataTable
                --------------------------------------------
                --------------------------------------------*/
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('goods.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
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
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                /*------------------------------------------
                --------------------------------------------
                Click to Button
                --------------------------------------------
                --------------------------------------------*/
                $('#createNewProduct').click(function() {
                    $('#saveBtn').val("create-product");
                    $('#product_id').val('');
                    $('#productForm').trigger("reset");
                    $('#modelHeading').html("Create New Product");
                    $('#ajaxModel').modal('show');
                });

                /*------------------------------------------
                --------------------------------------------
                Click to Edit Button
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '.editProduct', function() {
                    var product_id = $(this).data('id');
                    $.get("{{ route('goods.index') }}" + '/' + product_id + '/edit', function(
                        data) {
                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').val("edit-user");
                        $('#ajaxModel').modal('show');
                        $('#good_id').val(data.id);
                        $('#item_name').val(data.item_name);
                        $('#item_university').val(data.item_university);
                        $('#poster_name').val(data.poster_name);
                        $('#poster_email').val(data.poster_email);
                        $('#poster_phone').val(data.poster_phone);
                        $('#price').val(data.price);
                    })
                });

                /*------------------------------------------
                --------------------------------------------
                Create Product Code
                --------------------------------------------
                --------------------------------------------*/
                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('Saving ..');

                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ route('goods.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {

                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.draw();

                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                });

                /*------------------------------------------
                --------------------------------------------
                Delete Product Code
                --------------------------------------------
                --------------------------------------------*/
                $('body').on('click', '.deleteProduct', function() {

                    var product_id = $(this).data("id");
                    confirm("Are You sure want to delete !");

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('goods.store') }}" + '/' + product_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                });

            });
        </script>

        </html>

    </div>
@endsection
