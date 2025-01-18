<?php

namespace App\Http\Controllers\Api;
use App\Traits\HttpResponses;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */

    public function index($username)
    {
        $user = User::with('articles')->where("username", $username)->first();

        if (!$user) {
            return $this->error([], "User not found", 403);
        }

        return $this->success([
            'success' => true,
            'data'    => [
                'user'     => $user,
                'articles' => $user->articles,
            ],
        ]);
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
    public function store(StoreUserRequest $request)
    {
        $request->validated($request->all());


        if ($request->password) {

            $user = User::create([
                "name"     => $request->name,
                "username" => $request->username,
                "email"    => $request->email,
                "password" => Hash::make($request->password),
                "is_admin" => 0
            ]);
            $token = $user->createToken("auth_token_" . $user->email)->plainTextToken;
            return $this->success([
                "user"  => $user,
                "token" => $token,
            ]);

        }
    }
    public function authenthicate(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only("email", "password"))) {
            return $this->error('', "Credentials do not match", 401);
        }

        $user = User::where("email", $request->email)->first();
        $token = $user->createToken("auth_token_" . $user->email)->plainTextToken;
        return $this->success([
            "user"  => $user,
            "token" => $token,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request->validated();
        $authenticatedUser = auth()->user();

        // Check if the authenticated user ID matches the ID in the request
        if ($authenticatedUser->id != $id) {
            return $this->error('', "Unauthorized action", 403);
        }

        // Retrieve the user based on the provided id
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return $this->error('', "User not found", 404);
        }

        // Verify the provided password matches the user's current password
        if (Hash::check($request->password, $user->password)) {
            // Update the name if provided
            $user->name = $request->filled('name') ? $request->name : $user->name;

            // Check if a new username was provided and if it's different from the current username
            if ($request->filled('username') && $request->username !== $user->username) {
                // Check if the new username is unique
                $existingUser = User::where('username', $request->username)->first();
                if ($existingUser) {
                    return $this->error('', "The username is already taken", 422);
                }
                // If unique, update the username
                $user->username = $request->username;
            }

            // Check if the user wants to change the password
            if ($request->filled('new_password')) {
                if ($request->new_password === $request->new_password_confirmation) {
                    $user->password = Hash::make($request->new_password);
                } else {
                    return $this->error('', "New password and confirmation do not match", 422);
                }
            }

            // Save the updated user information
            $user->save();

            $token = $request->bearerToken();

            return $this->success([
                'user'  => $user,
                'token' => $token,
            ]);
        } else {
            return $this->error('', "Credentials do not match", 401);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function logout(User $user)
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            "message" => "You have successfully been logged out and your token has been deleted !",
        ]);
    }
    public function destroy(DeleteUserRequest $request, $id)
    {
        $request->validated();
        $authenticatedUser = auth()->user();

        // Check if the authenticated user ID matches the ID in the request
        if ($authenticatedUser->id != $id) {
            return $this->error('', "Unauthorized action", 403);
        }

        // Retrieve the user based on the provided id
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return $this->error('', "User not found", 404);
        }

        if (Hash::check($request->password, $user->password)) {

            // Delete the user
            $user->delete();

            // Invalidate the current access token
            $request->user()->currentAccessToken()->delete();

            // Return a success response
            return $this->success([
                "message" => "You have successfully deleted your account and invalidated your token!",
            ]);
        } else {
            return $this->error('', "Credentials do not match", 401);
        }
    }
}
