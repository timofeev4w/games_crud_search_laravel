<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    // Find or create genre and save in tables genres and game_genre
    static function findGenreOrCreate($genres_input, $game_id)
    {
        $genres = Genre::whereIn('name', $genres_input)
            ->get();
        foreach ($genres_input as $key => $genre_input) {
            if ($genre_input == '') {
                unset($genres_input[$key]);
                continue;
            }
            
            $genre_isset = false;
            foreach ($genres as $genre_bd) {
                if ($genre_input == $genre_bd->name) {
                    GameGenre::create([
                        'genre_id' => $genre_bd->id,
                        'game_id' => $game_id
                    ]);
                    $genre_isset = true;
                    break;
                }
            }

            if ($genre_isset == false) {
                $genre = Genre::create([
                    'name' => $genre_input
                ]);
                GameGenre::create([
                    'genre_id' => $genre->id,
                    'game_id' => $game_id
                ]);
            }
        }
    }

    // Find all genres in genre_table
    // 1 delete all and create new
    // 2 find all genres id, find this id in game_genre, then update/delete and create new

    // Find genre and update(with delete or create) tables genres and game_genre
    static function genreUpdateOrCreate($genres_input, $game_id)
    {
        GameGenre::where('game_id', $game_id)
            ->delete();

        $genres = Genre::whereIn('name', $genres_input)
            ->get();
        foreach ($genres_input as $key => $genre_input) {
            if ($genre_input == '') {
                unset($genres_input[$key]);
                continue;
            }
            
            $genre_isset = false;
            foreach ($genres as $genre_bd) {
                if ($genre_input == $genre_bd->name) {
                    GameGenre::create([
                        'genre_id' => $genre_bd->id,
                        'game_id' => $game_id
                    ]);
                    $genre_isset = true;
                    break;
                }
            }

            if ($genre_isset == false) {
                $genre = Genre::create([
                    'name' => $genre_input
                ]);
                GameGenre::create([
                    'genre_id' => $genre->id,
                    'game_id' => $game_id
                ]);
            }
        }
    }
}
