<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::first();
        if (request()->ajax()) {
            return datatables()->of(Goods::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.goods.goods', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'item_name'    =>  'required',
            'item_university'     =>  'required',
            'poster_name'    =>  'required',
            'poster_email'     =>  'required',
            'poster_phone'    =>  'required',
            'price'     =>  'required',
            'image'         =>  'required|image'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);

        $form_data = array(
            'item_name'        =>  $request->item_name,
            'item_university'         =>  $request->item_university,
            'poster_name'        =>  $request->poster_name,
            'poster_email'        =>  $request->poster_email,
            'poster_phone'        =>  $request->poster_phone,
            'price'        =>  $request->price,
            'image'             =>  $new_name
        );

        Goods::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Goods::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '') {
            $rules = array(
                'first_name'    =>  'required',
                'last_name'     =>  'required',
                'image'         =>  'image|max:2048'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        } else {
            $rules = array(
                'first_name'    =>  'required',
                'last_name'     =>  'required'
            );

            $error = Validator::make($request->all(), $rules);

            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'first_name'       =>   $request->first_name,
            'last_name'        =>   $request->last_name,
            'image'            =>   $image_name
        );
        Goods::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $data = Goods::findOrFail($id);
        $data->delete();
    }
}
