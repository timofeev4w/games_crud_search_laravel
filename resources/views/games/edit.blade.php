@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-5 pb-4">
        <div class="d-flex justify-content-center">
            <h1>
                Edit <a href="/games" class="text-decoration-none ">Game</a> 
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
          <form action="/games/{{ $game->id }}" method="POST">
              @csrf
              @method('put')
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" 
                value="@if(old('name') == null){{ $game->name }}@else{{ old('name') }}@endif">
                <label for="name">Name</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="studio" id="studio" placeholder="Studio"
                value="@if(old('studio') == null){{ $game->studio->name }}@else{{ old('studio') }}@endif">
                <label for="studio">Studio</label>
              </div>

              <div class="mb-2 add-genre">
                <label class="form-label fw-bold">Genres</label>
                @if (old('genre') == null)
                  @foreach($game->genres as $genre)
                      <input type="text" class="form-control mb-1" name="genre[{{ $loop->index }}]" 
                      placeholder="Genre"
                      value="{{ $genre->name }}">
                  @endforeach
                @else
                  @foreach(old('genre') as $genre)
                    <input type="text" class="form-control mb-1" name="genre[{{ $loop->index }}]" 
                    placeholder="Genre"
                    value="{{ $genre }}">
                  @endforeach
                @endif
              </div>


              <div class="mb-4">
                <button type="button" class="btn btn-success btn-add-genre">Add genre</button>
              </div>
              <button type="submit" class="btn btn-primary">Update Game</button>
            </form>
        </div>
    </div>
    <div class="row">
      <div class="d-flex justify-content-center">

        @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
              <li class="text-danger">{{ $error }}</li>
            @endforeach
          </ul>
        @endif

      </div>
    </div>
</div>
@endsection

@section('js')
<script src="/js/jquery-3.6.0.min.js"></script>
<script>
 
  @if(old('genre') != null)
    let genre_counter = {{ count(old('genre')) }};
  @else
    let genre_counter = {{ count($game->genres) }};
  @endif
  
</script>
<script src="/js/games_create.js"></script>
@endsection