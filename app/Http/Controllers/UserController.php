<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function show(User $user) {
        $reviews = Review::all()->sortBy('updated_at');
        return view('user.show', ['user' => $user, 'reviews' => $reviews, 'rates' => self::getRates()]);
    }

    public function edit(User $user) {
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request) {
        if ($request->id == Auth::user()->id) {
            $validatedData = $request->validate([
                'name' => 'required|min:4|max:50',
                'email' => 'required|email',
                'password_confirmation' => 'nullable|min:8',
                'password' => 'nullable|min:8|confirmed',
            ]);
            
            $user = Auth::user();
            $user->name = $request->name;
            
            if($request->hasFile('file') && $request->file('file')->isValid()) {
                if($user->profile_picture != 'default_picture.jpg') {
                    Storage::delete('public/images/'.$user->profile_picture);
                }
                $file = $request->file('file');
                $user->profile_picture = 'user_' . $user->id . '_profile_picture.' .  $file->extension();
                $file->storeAs('public/images', $user->profile_picture);
            }
            
            if ($request->password != null) {
                $user->password = Hash::make($request->input('password'));
            } else if($request->password != null) {
                return back()
                    ->withInput()
                    ->withErrors(['password_confirmation' => 'The old password does not match']);
            }
            
            try {
                $user->update();
                $message = 'User has been updated.';
                return redirect('user/' . $user->id);
            } catch(\Exception $e) {
                return back()
                    ->withInput()
                    ->withErrors(['password_confirmation' => 'The old password does not match']);
            }
        } else {
            return back()->withInput()->withErrors(['default' => '']);
        }
    }
    
     private static function getRates() {
        return [
            '0' => 'Awfull',
            '1' => 'Bad',
            '2' => 'Ok',
            '3' => 'Fine',
            '4' => 'Very Good',
            '5' => 'Excellent',
        ];
    }
}
