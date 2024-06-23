<?php

namespace app\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar si el usuario autenticado tiene el rol de administrador
        if (Auth::user()->hasRole('Admin')) {
            // Si el usuario es un administrador, retornar todos los usuarios
//            $users = User::all();
//            return response()->json($users);
//            return new UserCollection(User::all());
              return  UserResource::collection(User::all());
        } else {
            // Si el usuario no es un administrador, retornar un mensaje de error
            return response()->json(['message' => 'Unauthorized'], 403);
        }

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
    public function show(string $id)
    {
//        $user = User::find($id);
//        if (!$user) {
//            return response()->json(['message' => 'User not found'], 404);
//        }
//        return $user;

        if(User::find($id)) {
            return new UserResource(User::findOrFail($id));
        }
        return response()->json(['message' => 'User not found'], 404);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response('User not found',404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|in:artisan,authenticated_client',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        try {
            $user->delete();
            return response()->json(['message' => 'User and related orders and addresses deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
        }

    }

    public function getUserAddresses($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $addresses = $user->addresses; // Obtener las direcciones asociadas al usuario

        return response()->json($addresses, 200);
    }
}
