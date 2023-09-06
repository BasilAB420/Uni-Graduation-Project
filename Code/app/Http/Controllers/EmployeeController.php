<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    // set index page view
    public function index()
    {
        $user = User::first();
        return view('admin.pages.goods.goods', compact('user'));
    }

    // handle fetch all eamployees ajax request
    public function fetchAll()
    {
        $emps = Employee::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>item_name</th>
                <th>item_university</th>
                <th>poster_name</th>
                <th>poster_email</th>
                <th>poster_phone</th>
                <th>price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->item_name . '</td>
                <td>' . $emp->item_university . '</td>
                <td>' . $emp->poster_name . '</td>
                <td>' . $emp->poster_email . '</td>
                <td>' . $emp->poster_phone . '</td>
                <td>' . $emp->price . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new employee ajax request
    public function store(Request $request)
    {
        $file = $request->file('avatar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $empData = ['item_name' => $request->item_name, 'item_university' => $request->item_university, 'poster_name' => $request->poster_name, 
        'poster_email' => $request->poster_email, 'poster_phone' => $request->poster_phone,'price' => $request->price, 'avatar' => $fileName];
        Employee::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an employee ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Employee::find($id);
        return response()->json($emp);
    }

    // handle update an employee ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Employee::find($request->emp_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->avatar) {
                Storage::delete('public/images/' . $emp->avatar);
            }
        } else {
            $fileName = $request->emp_avatar;
        }

        $empData = ['item_name' => $request->item_name, 'item_university' => $request->item_university, 'poster_name' => $request->poster_name, 
        'poster_email' => $request->poster_email, 'poster_phone' => $request->poster_phone,'price' => $request->price, 'avatar' => $fileName];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an employee ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Employee::find($id);
        if (Storage::delete('public/images/' . $emp->avatar)) {
            Employee::destroy($id);
        }
    }
}
