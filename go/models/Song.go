package models

import (
	"database/sql"
	"time"
)

type Song struct {
	Id           int64         `json:"id"`
	IsPlaying    bool          `json:"is_playing"`
	Duration     time.Duration `json:"duration"`
	LastPlayedAt time.Time     `json:"last_played_at"`
}

func (song *Song) UpdateIsPlaying(tx *sql.Tx) (err error) {
	result, err := tx.Exec(
		"update song set is_playing = $1, last_played_at = $2 where id = $3",
		song.IsPlaying,
		song.LastPlayedAt,
		song.Id,
	)
	if err != nil {
		return err
	}
	print(result)
	return nil
}

func (song *Song) FindById(tx *sql.Tx) (*Song, error) {
	row := tx.QueryRow("select id, is_playing, duration, last_played_at from song where id = $1", song.Id)
	err := row.Scan(&song.Id, &song.IsPlaying, &song.Duration, &song.LastPlayedAt)
	if err != nil {
		return nil, err
	}
	return song, nil
}

func FindPlaying(tx *sql.Tx) (*Song, error) {
	var song Song
	row := tx.QueryRow("select id, is_playing, duration, last_played_at from song where is_playing = true limit 1")
	err := row.Scan(&song.Id, &song.IsPlaying, &song.Duration, &song.LastPlayedAt)
	if err != nil {
		if err == sql.ErrNoRows {
			return nil, nil
		}
		return nil, err
	}
	return &song, nil
}
