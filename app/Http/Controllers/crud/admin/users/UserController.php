<?php

namespace App\Http\Controllers\crud\admin\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select("SELECT `id`, `name`, `email`  FROM `users`");
        return view('crud.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = DB::select(SELECT `id`, `name` FROM `companies`);

        return view('crud.admin.users.create', compact('companies-'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::insert("INSERT INTO `users` (`name`, `email`, `password`) VALUES ('" . $request->name . "', '" . $request->email . "', '" . $request->password . "')");

        $users = DB::select("SELECT `id`, `name`, `email`  FROM `users`");
        return view('crud.admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = DB::select("SELECT `id`, `name`, `email`, `password`  FROM `users` WHERE `id` = '" . $id . "'");
        return view('crud.admin.users.edit', compact('user', 'id'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::update("UPDATE `users` SET `name` = '" . $request->name . "', `email` = '" . $request->email . "', `password` = '" . $request->password . "' WHERE `id` = '" . $id . "' ");

        $users = DB::select("SELECT `id`, `name`, `email`  FROM `users`");
        return view('crud.admin.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
