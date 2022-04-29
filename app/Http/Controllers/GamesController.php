<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameCreatePostRequest;
use App\Http\Requests\GameUpdatePostRequest;
use App\Models\Game;
use App\Models\GameGenre;
use App\Models\GameStudio;
use App\Models\Genre;
use Illuminate\Http\Request;
// use App\

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        
        return view('games.index', [
            'games' => $games
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreatePostRequest $request)
    {
        $request->validated();

        // Find or create studio
        $studio = GameStudio::where('name', $request->input('studio'))
            ->firstOrCreate([
                'name' => $request->input('studio')
            ]);
        
        // Create game
        $game = Game::create([
            'name' => $request->input('name'),
            'studio_id' => $studio->id
        ]);

        // Find or create genre and save in table game_genre
        $genres = Genre::findGenreOrCreate($request->input('genre'), $game->id);

        return redirect('/games');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);

        return view('games.edit', [
            'game' => $game
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameUpdatePostRequest $request, $id)
    {
        $request->validated();

        // Find or create studio
        $studio = GameStudio::where('name', $request->input('studio'))
            ->firstOrCreate([
                'name' => $request->input('studio')
            ]);
        
        // Create game
        $game = Game::where('id', $id)->update([
            'name' => $request->input('name'),
            'studio_id' => $studio->id
        ]);
        // dd($game);

        // Find or create genre and save in table game_genre
        $genres = Genre::genreUpdateOrCreate($request->input('genre'), $id);

        return redirect('/games');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();

        return redirect('/games');
    }
}
