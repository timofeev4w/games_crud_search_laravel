<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStudio extends Model
{
    use HasFactory;

    protected $table = 'game_studios';

    protected $fillable = ['name'];

    public $timestamps = false;
}
