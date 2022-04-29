@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-5 pb-4">
        <div class="d-flex justify-content-center">
            <h1>
                Add <a href="/games" class="text-decoration-none ">Game</a> 
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
          <form action="/games" method="POST">
              @csrf
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" 
                value="{{ old('name') }}">
                <label for="name">Name</label>
                {{-- <br>
                @error('name')
                    
                @enderror --}}
              </div>
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="studio" id="studio" placeholder="Studio"
                  value="{{ old('studio') }}">
                  <label for="studio">Studio</label>
                </div>
                <div class="mb-2 add-genre">
                  <label class="form-label fw-bold">Genres</label>
                  {{-- <input type="text" class="form-control mb-1" name="genre[0]" placeholder="Add genre"
                  value="{{ old('genre.0') }}"> --}}

                  @if (old('genre') != null)
                    @foreach(old('genre') as $genre)
                      <input type="text" class="form-control mb-1" name="genre[{{ $loop->index }}]" placeholder="Add genre"
                      value="{{ $genre }}">
                    @endforeach
                  @else
                    <input type="text" class="form-control mb-1" name="genre[0]" placeholder="Add genre">
                  @endif
                </div>


                <div class="mb-4">
                  <button type="button" class="btn btn-success btn-add-genre">Add genre</button>
                </div>
              <button type="submit" class="btn btn-primary">Save Game</button>
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
    let genre_counter = 1;
  @endif
  
</script>
<script src="/js/games_create.js"></script>

@endsection