<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Feeds;
use App\Http\Resources\Feed as FeedResource;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $feeds= Feeds::paginate(10);
        return FeedResource::collection($feeds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feed = $request->isMethod('put')?Feeds::findOrFail($request->feed_id):new Feeds;
        
        $feed->id= $request->input('feed_id');
        $feed->title= $request->input('title');
        $feed->body= $request('body');
        $feed->image= "Test Image String";
        $feed->link="Test Link String";
        $feed->user_id=4;
        
        if($feed->save())
        {
            return new FeedResource($feed);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feed = Feeds::findOrFail($id);
        return new FeedResource($feed);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feed = Feeds::findOrFail($id);
        if ($feed->delete()){
            return new FeedResource($feed);
        }
       
    }
}
