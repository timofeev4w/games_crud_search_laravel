'use strict';

let html_add_genre_start = `<input type="text" class="form-control mb-1" name="genre[`;
let html_add_genre_end = `]" placeholder="Add genre"></input>`;

$('.btn-add-genre').on('click', function() {
    $('.add-genre').append(
        html_add_genre_start + genre_counter + html_add_genre_end
    );
    genre_counter++;
    
});