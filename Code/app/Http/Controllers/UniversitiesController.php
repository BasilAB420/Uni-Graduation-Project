<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UniversitiesController extends Controller
{
    public function index()
    {
        $user = User::first();

        if (request()->ajax()) {
            return datatables()->of(Universities::select('*'))
                ->addColumn('action', 'product-button')
                ->addColumn('image', 'image')
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.pages.universities.universities', compact('user'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productId = $request->product_id;

        $details = ['name' => $request->name];

        if ($files = $request->file('image')) {

            //delete old file
            File::delete('public/product/' . $request->hidden_image);

            //insert new file
            $destinationPath = 'public/product/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $details['image'] = "$profileImage";
        }

        $product   =   Universities::updateOrCreate(['id' => $productId], $details);

        return Response::json($product);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = Universities::where($where)->first();

        return Response::json($product);
    }
    public function destroy($id)
    {
        $data = Universities::where('id', $id)->first(['image']);
        File::delete('public/product/' . $data->image);
        $product = Universities::where('id', $id)->delete();

        return Response::json($product);
    }
}
