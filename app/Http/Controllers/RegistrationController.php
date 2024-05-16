<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }
    public function register(RegistrationRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->full_name = $validated['full_name'];
        $user->user_name = $validated['user_name'];
        $user->birthdate = $validated['birthdate'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->password = Hash::make($validated['password']);
        $user->email = $validated['email'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('uploads');
            $user->image = $path;
        }
        
        if ($user->save()) {
            return response()->json(['message' => 'Registration successful!'], 200);
            

        } else {
            return response()->json(['message' => 'An error occurred during registration.'], 500);
        }
    }
}
