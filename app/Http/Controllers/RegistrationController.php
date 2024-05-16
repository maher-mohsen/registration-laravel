<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Exception; // Import the Exception class if not already imported

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(RegistrationRequest $request)
    {
        
        try {
            $validated = $request->validated();
            Log::debug('Debugging message.' . $validated);
        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during registration.'], 409);
        }
        

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


        try{
            $user->save();
            return response()->json(['message' => 'Registration successful!'], 200);
        }catch(Exception $e){
            return response()->json(['message' => 'An error occurred during registration.'], 409);
        }


        // if ($user->save()) {
        //     Log::info('User registered successfully: ' . $user->id);

        //     return response()->json(['message' => 'Registration successful!'], 200);
        // } else {
        //     return response()->json(['message' => 'An error occurred during registration.'], 409);
        // }
    }
}

