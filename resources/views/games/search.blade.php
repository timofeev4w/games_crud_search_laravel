@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pt-5 pb-4">
            <div class="d-flex justify-content-center">
                <h1>
                    {{ $genre_name }} <a href="/games" class="text-decoration-none ">Game</a> 
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <form action="/games/s" method="POST">
                    @csrf
                    <label for="genre_name" class="form-label">Search genre</label>
                    <input class="form-control" list="datalistOptions" id="genre_name" name="genre_name" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        @foreach($genres_all as $genre)
                            <option value="{{ $genre->name }}">
                        @endforeach
                    </datalist>
                </form>
            </div>
        </div>

        @if($games != null)
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Title</th>
                        <th scope="col">Studio</th>
                        <th scope="col">Genres</th>
                    </thead>
                    <tbody>
                        @forelse ($games as $game)
                            <tr>
                                <td class="text-decoration-underline">
                                    {{ $game->name }}
                                </td>
                                <td>
                                    {{ $game->studio->name }}
                                    
                                </td>
                                <td>
                                    @forelse ($game->genres as $genre)
                                        {{ $genre->name }}<br>
                                    @empty
                                        No genre
                                    @endforelse
                                </td>
                                <td>
                                    <a href="/games/{{ $game->id }}/edit" class="btn btn-success btn-sm mb-1">Update</a><br>
                                    <form action="/games/{{ $game->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
        <div class="row">
            <div class="d-flex justify-content-center">
                <h1>No games with this genre!</h1>
            </div>
        </div>
        @endisset
    </div>
@endsection