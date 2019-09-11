create table if not exists genres
(
    id      integer primary key autoincrement not null,
    name    varchar                           not null,
    tmdb_id integer                           not null
);

create table if not exists movies
(
    id           integer primary key autoincrement not null,
    name         varchar                           not null,
    poster       varchar,
    backdrop     varchar,
    overview     text                              not null,
    release_date date                              not null,
    tmdb_id      integer                           not null
);

create table if not exists genre_movie
(
    genre_id integer not null,
    movie_id integer not null,
    foreign key (genre_id) references genres (id),
    foreign key (movie_id) references movies (id)
);