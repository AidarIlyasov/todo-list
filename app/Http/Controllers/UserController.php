<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        var_dump($request->all());
       return Str::random(60);
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
        echo "Hello world";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return string
     */
    public function update(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        $user->name = $request->name;
        $user->save();

        $this->saveUserPhoto($request, $userId);
        return response()->json($user, 200);
    }

    /**
     * save user photo
     * @param Request $request
     * @param int $userId
     */
    private function saveUserPhoto(Request $request, int $userId)
    {
        if (!is_null($request->file('image'))) {
            $pathToFile = $request->file('image')->storeAs("images/users/{$userId}", 'profile.jpg');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test(Request $request, Board $board)
    {

//        $user = User::where('email', '=', $email)->first();

        $this->authorize('update', $board);
        dd($request->user()->id);
    }
}
