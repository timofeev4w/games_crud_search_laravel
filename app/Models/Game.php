<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $primary_key = 'id';

    protected $fillable = ['name', 'studio_id'];

    public $timestamps = false;

    // public function gameGenres()
    // {
    //     return $this->belongsToMany(GameGenre::class);
    // }

    // public function gameStudio()
    // {
    //     return $this->belongsToMany(GameStudio::class);
    // }

    // public function studio()
    // {
    //     return $this->hasOne(GameStudio::class);
    // }

    public function studio()
    {
        return $this->belongsTo(GameStudio::class, 'studio_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    static function getGamesByGenre($genre_name)
    {
        $genre = Genre::where('name', $genre_name)->first();
        $games_genre = GameGenre::where('genre_id', $genre->id)
            ->get();
        foreach ($games_genre as $game_genre) {
            $game_ids[] = $game_genre['game_id'];
        }
        if (isset($game_ids)) {
            return Game::whereIn('id', $game_ids)
            ->get();
        }
        
    }
}
