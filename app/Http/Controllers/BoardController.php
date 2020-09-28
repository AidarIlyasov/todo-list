<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function __construct()
    {
       $this->authorizeResource(Board::class, 'board');
//        $this->authorizeResource(Post::class, 'post');
    }
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
     * @param Board $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $boardUsers = DB::table('board_user as bu')
            ->join('users as u', 'u.id','=', 'bu.user_id')
            ->select('u.id', 'u.name', 'u.email', 'bu.access')
            ->where('bu.board_id', $board->id)
            ->get();

        $boardTaks = DB::table('tasks')
            ->where('board_id', $board->id)
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
     * @param \Illuminate\Http\Request $request
     * @param Board $board
     * @return void
     */
    public function update(Request $request, Board $board)
    {
        $board->bg_image = $request->image;
        $board->save();
        dd(array($request->image, $board->id));
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

    /**
     * Remove user resource from board.
     *
     * @param  int  $board
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destoryUser($board, $user)
    {
        DB::table('board_user')->where([
            ['board_id', '=', $board],
            ['user_id', '=', $user],
        ])->delete();

        dump(array($board, $user));
    }
}
