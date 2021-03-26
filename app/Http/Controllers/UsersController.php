<?php

namespace App\Http\Controllers;

use App\Models\Users;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return Users::all();
    }

    public function create(Request $request)
    {
        $params = $request->all();
        
        $user = Users::create($params);

        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $user->update($request->all());

        return $user;
    }
}
