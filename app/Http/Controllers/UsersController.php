<?php

namespace App\Http\Controllers;

use App\Models\Users;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Response;

class UsersController extends Controller
{
    /**
     * GET /users
     * 
     * Returns the full list of users from the `users` table
     * 
     * @return array $users
     */
    public function getList()
    {
        $users = Users::all();

        return Response::json($users, 200);
    }

    /**
     * POST /users/create
     * 
     * Creates a new user resource
     * 
     * @param string first_name
     * @param string last_name
     * @param string email
     * 
     * @return object $user
     */
    public function create(Request $request)
    {
        $params = $request->all();
        $validated = Users::validateUser($params, true);
        
        if ($validated['valid']) {
            $user = Users::create($params);
        } else {
            return Response::json($validated, 400);
        }

        return Response::json($user, 201);
    }

    /**
     * POST /users/update
     * 
     * Updates a user resource
     * 
     * @param string first_name (optional)
     * @param string last_name (optional)
     * @param string email  (optional)
     * 
     * @return object $user
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $validated = Users::validateUser($params);
        
        if ($validated['valid']) {
            try {
                $user = Users::findOrFail($id);
            } catch (\Exception $e) {
                return Response::json(['error' => 'Resource not found'], 404);
            }

            $user->update($params);
        } else {
            return Response::json($validated, 400);
        }

        return Response::json($user, 200);
    }
}
