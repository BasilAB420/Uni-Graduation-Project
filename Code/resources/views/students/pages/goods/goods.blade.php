@extends('admin.layouts.master')

@section('content')
    <!-- Team Start -->
    <div class="container-xxl py-5">

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CRUD App Laravel 8 & Ajax</title>
            <link rel='stylesheet'
                href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
            <link rel='stylesheet'
                href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

        </head>
        {{-- add new employee modal start --}}
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body p-4 bg-light">
                            <div class="col-lg">
                                <label for="item_name">item_name</label>
                                <input type="text" name="item_name" class="form-control" placeholder="Item Name"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="item_university">item_university</label>
                                <input type="text" name="item_university" class="form-control"
                                    placeholder="item_university" required>
                            </div>
                            <div class="my-2">
                                <label for="phone">poster_name</label>
                                <input type="text" name="poster_name" class="form-control" placeholder="poster_name"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="poster_email">poster_email</label>
                                <input type="text" name="poster_email" class="form-control" placeholder="poster_email"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="poster_phone">poster_phone</label>
                                <input type="text" name="poster_phone" class="form-control" placeholder="poster_phone"
                                    required>
                            </div>
                            <div class="my-2">
                                <label for="price">price</label>
                                <input type="text" name="price" class="form-control" placeholder="price" required>
                            </div>
                            <div class="my-2">
                                <label for="avatar">Select Avatar</label>
                                <input type="file" name="avatar" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- add new employee modal end --}}

        {{-- edit employee modal start --}}
        <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="emp_id" id="emp_id">
                        <input type="hidden" name="emp_avatar" id="emp_avatar">
                        <div class="modal-body p-4 bg-light">
                            <div class="row">
                                <div class="col-lg">
                                    <label for="item_name">item_name</label>
                                    <input type="text" name="item_name" id="item_name" class="form-control"
                                        placeholder="item_name" required>
                                </div>
                                <div class="col-lg">
                                    <label for="item_university">item_university</label>
                                    <input type="text" name="item_university" id="item_university"
                                        class="form-control" placeholder="item_university" required>
                                </div>
                            </div>
                            <div class="my-2">
                                <label for="poster_name">poster_name</label>
                                <input type="text" name="poster_name" id="poster_name" class="form-control"
                                    placeholder="poster_name" required>
                            </div>
                            <div class="my-2">
                                <label for="poster_email">poster_email</label>
                                <input type="text" name="poster_email" id="poster_email" class="form-control"
                                    placeholder="poster_email" required>
                            </div>
                            <div class="my-2">
                                <label for="poster_phone">poster_phone</label>
                                <input type="text" name="poster_phone" id="poster_phone" class="form-control"
                                    placeholder="poster_phone" required>
                            </div>
                            <div class="my-2">
                                <label for="price">poster_phone</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    placeholder="price" required>
                            </div>
                            <div class="my-2">
                                <label for="avatar">Select Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="mt-2" id="avatar">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="edit_employee_btn" class="btn btn-success">Update
                                Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- edit employee modal end --}}

        <body class="bg-light">
            <div class="container">
                <div class="row my-5">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                                <h3 class="text-light">Manage Employees</h3>
                                <button class="btn btn-light" data-bs-toggle="modal"
                                    data-bs-target="#addEmployeeModal"><i class="bi-plus-circle me-2"></i>Add New
                                    Employee</button>
                            </div>
                            <div class="card-body" id="show_all_employees">
                                <h1 class="text-center text-secondary my-5">Loading...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $(function() {

                    // add new employee ajax request
                    $("#add_employee_form").submit(function(e) {
                        e.preventDefault();
                        const fd = new FormData(this);
                        $("#add_employee_btn").text('Adding...');
                        $.ajax({
                            url: '{{ route('store') }}',
                            method: 'post',
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire(
                                        'Added!',
                                        'Employee Added Successfully!',
                                        'success'
                                    )
                                    fetchAllEmployees();
                                }
                                $("#add_employee_btn").text('Add Employee');
                                $("#add_employee_form")[0].reset();
                                $("#addEmployeeModal").modal('hide');
                            }
                        });
                    });

                    // edit employee ajax request
                    $(document).on('click', '.editIcon', function(e) {
                        e.preventDefault();
                        let id = $(this).attr('id');
                        $.ajax({
                            url: '{{ route('edit') }}',
                            method: 'get',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $("#item_name").val(response.item_name);
                                $("#item_university").val(response.item_university);
                                $("#poster_name").val(response.poster_name);
                                $("#poster_email").val(response.poster_email);
                                $("#poster_phone").val(response.poster_phone);
                                $("#price").val(response.price);
                                $("#avatar").html(
                                    `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`
                                );
                                $("#emp_id").val(response.id);
                                $("#emp_avatar").val(response.avatar);
                            }
                        });
                    });

                    // update employee ajax request
                    $("#edit_employee_form").submit(function(e) {
                        e.preventDefault();
                        const fd = new FormData(this);
                        $("#edit_employee_btn").text('Updating...');
                        $.ajax({
                            url: '{{ route('update') }}',
                            method: 'post',
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 200) {
                                    Swal.fire(
                                        'Updated!',
                                        'Employee Updated Successfully!',
                                        'success'
                                    )
                                    fetchAllEmployees();
                                }
                                $("#edit_employee_btn").text('Update Employee');
                                $("#edit_employee_form")[0].reset();
                                $("#editEmployeeModal").modal('hide');
                            }
                        });
                    });

                    // delete employee ajax request
                    $(document).on('click', '.deleteIcon', function(e) {
                        e.preventDefault();
                        let id = $(this).attr('id');
                        let csrf = '{{ csrf_token() }}';
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ route('delete') }}',
                                    method: 'delete',
                                    data: {
                                        id: id,
                                        _token: csrf
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )
                                        fetchAllEmployees();
                                    }
                                });
                            }
                        })
                    });

                    // fetch all employees ajax request
                    fetchAllEmployees();

                    function fetchAllEmployees() {
                        $.ajax({
                            url: '{{ route('fetchAll') }}',
                            method: 'get',
                            success: function(response) {
                                $("#show_all_employees").html(response);
                                $("table").DataTable({
                                    order: [0, 'desc']
                                });
                            }
                        });
                    }
                });
            </script>
        </body>

        </html>

    </div>
@endsection
