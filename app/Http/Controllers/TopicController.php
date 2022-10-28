<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return response()->json(["data" => Topic::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $topic = new Topic;

            $topic->title = $request->title;
            $topic->body = $request->body;
            $topic->url = $request->url;
            $topic->subject_id = $request->subject_id;
            $topic->teacher_id = $request->teacher_id;

            $topic->save();

            return response()->json(["data" => [$topic]], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Data not saved",
                "error" => $th->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return response()->json(["data" => $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {

        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->url = $request->url;
        $topic->subject_id = $request->subject_id;
        $topic->teacher_id = $request->teacher_id;

        $topic->save();

        return $topic;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        try {
            $topic->delete();

            return response()->json(["data" => $topic, "message" => "Successful Delete"], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Unsuccessful Delete"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
