@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <a href="{{ route('goods.create') }}" class="btn btn-primary text-white my-3">Add New</a>
        <div class="card">
            <h5 class="card-header">All Goods</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th>#</th>
                            <th>University</th>
                            <th>Item Name</th>
                            <th>Poster Name</th>
                            <th>Poster E-mail</th>
                            <th>Poster Phone Number</th>
                            <th>Price</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row">1</th>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>
                                <a href=""><i class="bx bx-edit-alt"></i></a>
                            </td>

                            <td>
                                <a href=""><i class="bx bx-trash"></i></a>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
