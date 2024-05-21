<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Http\Controllers\mailer;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

require "mailer.php";
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
        } catch (ValidationException $e) {
            return redirect()->route('register.form')->withErrors($e->validator)->withInput();
        }

        $user = new User();
        $user->full_name = $validated['full_name'];
        $user->user_name = $validated['user_name'];
        $user->birthdate = $validated['birthdate'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->password = Hash::make($validated['password']);
        $user->email = $validated['email'];

        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $path = $image->store('uploads', 'public');
            $user->image = $path;
        }

        try {
            $user->save();
            $mail_data = ['validated'=> $validated];
            Mail::send('emails.confirmation', $mail_data, function($message)
            {
                $message->to('silvanajackoub54@gmail.com')->subject("New registered user");
            });
            
            return redirect()->route('register.form')->with('success', 'Registration successful!');
        } catch (QueryException $e) {
            return redirect()->route('register.form')->with('error', 'Email is already exist.')->withInput();
        }
    }

}


