<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::first();
        return view('admin.pages.goods.goods', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::first();
        return view('admin.pages.goods.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Goods $goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goods $goods)
    {
        //
    }
}
