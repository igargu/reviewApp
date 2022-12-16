<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $reviews = Review::all()->sortBy('updated_at');
        return view('home', ['user' =>  Auth::user(), 'reviews' => $reviews, 'rates' => self::getRates()]);
    }
    
    public function edit() {
        return view('user.edit', ['user' => Auth::user()]);
    }
    
    public function update(Request $request) {
        $validatedData = $this->validateInput($request);
        $message = 'User data has been updated.';
        $sendEmail = false;
        $user = Auth::user();
        $user->name = $request->name;
        if ($request->password != null && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->input('password'));
        } else if($request->password != null) {
            return back()
                ->withInput()
                ->withErrors(['old_password' => 'The old password does not match']);
        }
        if ($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $sendEmail = true;
        }
        if (!$user->updateUser($sendEmail)) {
          return back()
                ->withInput()
                ->withErrors(['old_password' => 'The old password does not match']);
        };
        if ($sendEmail) {
            $user->sendEmailVerificationNotification();
        }
        return redirect('home')->with('message', $message);
    }
    
    public function validateUpdate(Request $request) {
        return $request->validate([
            'name' => 'required|min:4|max:50',
            'email' => 'required|email',
            'old_password' => 'nullable|min:8',
            'password' => 'nullable|min:8|confirmed',
        ]);
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
