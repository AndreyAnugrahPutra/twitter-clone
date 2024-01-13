<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Welcome', [
            'tweets' => Tweet::orderBy('id', 'desc')->get()
        ]);
    }
    
    // upload tweet
    public function store(Request $request)
    {
        $file = null;
        $extension = null;
        $fileName = null;
        $path = null;

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $request->validate(['file' => 'required|mimes:jpg,jpeg,png,mp4']);
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $extension === 'mp4' ? $path = '/videos/' : $path = '/pics/';
        }

        $tweet = new Tweet;

        $tweet->name = 'Andrey Anugrah Putra';
        $tweet->handle = '@andrey_a_putra';
        $tweet->image = 'https://randomuser.me/api/portraits/men/27.jpg';
        $tweet->tweet = $request->input('tweet');

        if($fileName)
        {
            $tweet->file = $path.$fileName;
            $tweet->is_video = $extension === 'mp4' ? true : false;
            $file->move(public_path().$path, $fileName);
        }

        $tweet->comments = rand(19, 500);
        $tweet->retweets = rand(19, 500);
        $tweet->likes = rand(19, 500);
        $tweet->analytics = rand(19, 500);

        $tweet->save();
    }
    
    // hapus tweet
    public function destroy($id)
    {
        $tweet = Tweet::find($id);

        if(!is_null($tweet->file) && file_exists(public_path().$tweet->file))
        {
            unlink(public_path().$tweet->file);
        }

        $tweet->delete();

        return redirect()->route('tweets.index');
    }
}
