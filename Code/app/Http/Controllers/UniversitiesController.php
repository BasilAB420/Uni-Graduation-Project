<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Universities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UniversitiesController extends Controller
{

    // set index page view
    public function index()
    {
        $user = User::first();
        return view('admin.pages.universities.universities', compact(['user']));
    }

    // handle fetch all eamployees ajax request
    public function fetchAll()
    {
        $universities = Universities::all();
        $output = '';
        if ($universities->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($universities as $university) {
                $output .= '<tr>
                <td>' . $university->id . '</td>
                <td><img src="storage/images/' . $university->avatar . '" width="100" class="img-thumbnail rounded p-1"></td>
                <td>' . $university->name . ' </td>
                <td>
                  <a href="#" id="' . $university->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $university->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
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

        $universityData = ['name' => $request->name, 'avatar' => $fileName];
        Universities::create($universityData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an employee ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $university = Universities::find($id);
        return response()->json($university);
    }

    // handle update an employee ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $universities = Universities::find($request->universities_id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($universities->avatar) {
                Storage::delete('public/images/' . $universities->avatar);
            }
        } else {
            $fileName = $request->universities_avatar;
        }

        $universityData = ['name' => $request->name, 'avatar' => $fileName];

        $universities->update($universityData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an employee ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $universityData = Universities::find($id);
        if (Storage::delete('public/images/' . $universityData->avatar)) {
            Universities::destroy($id);
        }
    }
}
