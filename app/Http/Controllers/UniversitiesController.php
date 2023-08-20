<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UniversitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::first();
        return view('admin.pages.universities', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Universities $universities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Universities $universities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Universities $universities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Universities $universities)
    {
        //
    }
}
