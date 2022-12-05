create table action
(
    id         serial
        constraint action_pk
            primary key,
    name       varchar               not null,
    is_default boolean default false not null
);

create unique index action_name_uindex
    on action (name);


create table music_style
(
    id   serial
        constraint music_style_pk
            primary key,
    name varchar not null
);

create unique index music_style_name_uindex
    on music_style (name);


create table guest
(
    id   serial
        constraint guest_pk
            primary key,
    type varchar not null,
    name varchar not null
);


create table song
(
    id         serial
        constraint song_pk
            primary key,
    name       integer               not null,
    style_id   integer               not null
        constraint song_music_style_id_fk
            references music_style
            on update cascade on delete cascade,
    is_playing boolean default false not null,
    duration   integer               not null
);


create table dance_action
(
    id        integer default nextval('dance_action_id_seq'::regclass) not null
        constraint dance_action_pk
            primary key,
    dance_id  integer                                                  not null
        constraint dance_action_dance_id_fk
            references dance
            on update cascade on delete cascade,
    action_id integer                                                  not null
        constraint dance_action_action_id_fk
            references action
            on update cascade on delete cascade
);

create index dance_action_action_id_index
    on dance_action (action_id);

create index dance_action_dance_id_index
    on dance_action (dance_id);


create table music_style_dance
(
    id             serial
        constraint music_style_dance_pk
            primary key,
    music_style_id int not null
        constraint music_style_dance_music_style_id_fk
            references music_style
            on update cascade on delete cascade,
    dance_id       int not null
        constraint music_style_dance_dance_id_fk
            references dance
            on update cascade on delete cascade
);

create index music_style_dance_dance_id_index
    on music_style_dance (dance_id);

create index music_style_dance_music_style_id_index
    on music_style_dance (music_style_id);


create table skill
(
    id        serial
        constraint skill_pk
            primary key,
    guest_id  int not null
        constraint skill_guest_id_fk
            references guest
            on update cascade on delete cascade,
    action_id int not null
        constraint skill_action_id_fk
            references action
            on update cascade on delete cascade
);

create index skill_action_id_index
    on skill (action_id);

create index skill_guest_id_index
    on skill (guest_id);


