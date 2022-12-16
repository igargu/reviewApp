<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Image;

use App\Http\Requests\ReviewEditRequest;
use App\Http\Requests\ReviewCreateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

ini_set('display_errors', 1);
error_reporting(E_ALL);

class ReviewController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $reviews = Review::all()->sortBy('updated_at');
        return view('home', ['reviews' => $reviews, 'rates' => self::getRates()]);
    }

    public function create() {
        return view('review.create', [
                                      'types' => self::getTypes(),
                                      'rates' => self::getRates()
                                     ]);
    }

    public function store(ReviewCreateRequest $request) {
        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $image = new Image();
            $image->name = 'provisional';
            $image->save();
            
            $image = Image::where('name', 'provisional')->first();
            $image->name = $image->id . '.' . $file->extension();
            $image->update();
            
            $file->storeAs('public/images', $image->name);
        
            try {
                $review = new Review($request->all());
                $review->idimage = $image->id;
                $review->save();
                return redirect('review');
            } catch(\Exception $e) {
                return back()->withInput()->withErrors(['default' => 'An unexpected error occurred while creating.']);
            }
            
        } else {
            return back()->withInput()->withErrors(['default' => 'Invalid file.']);
        }
    }

    public function show(Review $review) {
        return view('review.show', ['review' => $review, 'rates' => self::getRates()]);
    }

    public function edit(Review $review) {
        return view('review.edit', [
                                    'review' => $review,
                                    'types' => self::getTypes(),
                                    'rates' => self::getRates()
                                    ]);
    }
    
    private static function getTypes() {
        return [
            'book' => 'Book',
            'disc' => 'Disc',
            'movie' => 'Movie',
        ];
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

    public function update(ReviewEditRequest $request, Review $review) {
        if ($review->user->id == Auth::user()->id) {
            try {
                if($request->hasFile('file') && $request->file('file')->isValid()) {
                    Storage::delete('public/images/'.$review->image->name);
                    $file = $request->file('file');
                    $file->storeAs('public/images', $review->image->name);
                }
                $review->update($request->all());
                return redirect('review/' . $review->id);
            } catch(\Exception $e) {
                return back()->withInput()->withErrors(['default' => '']);
            }
        } else {
            return back()->withInput()->withErrors(['default' => '']);
        }
    }

    public function destroy(Review $review) {
        if ($review->user->id == Auth::user()->id) {
            try {
                $review->delete();
                Storage::delete('public/images/'.$review->image->name);
                Image::where('id', $review->image->id)->first()->delete();
                return redirect('review');
            } catch(\Exception $e) {
                return back()->withErrors(['default' => '']);
            }
        } else {
            return back()->withInput()->withErrors(['default' => '']);
        }
    }
}
