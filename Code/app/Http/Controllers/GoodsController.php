<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class GoodsController extends Controller
{
    public function index()
    {
        $user = User::first();

        if (request()->ajax()) {
            return datatables()->of(Goods::select('*'))
                ->addColumn('action', 'product-button')
                ->addColumn('image', 'image')
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.pages.goods.goods', compact('user'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productId = $request->product_id;

        $details = [
            'item_name' => $request->item_name,
            'item_university' => $request->item_university,
            'poster_name' => $request->poster_name,

            'poster_email' => $request->poster_email,
            'poster_phone' => $request->poster_phone,
            'price' => $request->price


        ];

        if ($files = $request->file('image')) {


            //insert new file
            $destinationPath = 'public/product/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $details['image'] = "$profileImage";
        }

        $product   =   Goods::updateOrCreate(['id' => $productId], $details);

        return Response::json($product);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = Goods::where($where)->first();

        return Response::json($product);
    }
    public function destroy($id)
    {
        $data = Goods::where('id', $id)->first(['image']);

        $product = Goods::where('id', $id)->delete();

        return Response::json($product);
    }
}
