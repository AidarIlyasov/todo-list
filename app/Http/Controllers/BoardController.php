<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $boards = Board::select('id', 'title')->where('author_id', $userId)->get();
        return response()->json($boards, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board = DB::table('boards')
            ->select('*')
            ->where('id', $id)->first();

        $boardUsers = DB::table('board_user as bu')
            ->join('users as u', 'u.id','=', 'bu.user_id')
            ->select('u.id', 'u.name', 'u.email', 'bu.access')
            ->where('bu.board_id', $id)
            ->get();

        $boardTaks = DB::table('tasks')
            ->where('board_id', $id)
            ->get();

        $data = [
            'board' => $board,
            'users' => $boardUsers,
            'tasks' => $boardTaks
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $board = Board::findOrFail($id);
        $board->bg_image = $request->image;
        $board->save();
        dd(array($request->image, $id));
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
}
