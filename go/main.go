package main

import (
	"_go/app"
	"_go/models"
	"database/sql"
	"encoding/json"
	"log"
	"time"
)

type Song struct {
	Id int64 `json:"id"`
}

func main() {
	defer func() {
		err := recover()
		if err != nil {
			log.Println(err)
		}
	}()

	app.Init()
	log.Printf("[*] Waiting for messages. To exit press CTRL+C.")
	for {
		go dj()
		time.Sleep(5 * time.Second)
	}
}

func dj() {
	log.Println("DJing...")
	ch, err := app.Connection.Channel()
	app.FailOnError(err, "Opening amqp channel")
	defer ch.Close()
	q, err := ch.QueueDeclare(
		"songs",
		false,
		false,
		false,
		false,
		nil,
	)
	app.FailOnError(err, "Declare queue")

	tx, err := app.DataBase.Begin()
	app.FailOnError(err, "Begin transaction")
	defer tx.Rollback()
	playingSong, err := models.FindPlaying(tx)
	app.FailOnError(err, "Find playing")
	if playingSong != nil {
		// todo: нормальное сравнение времени окончания и текущего
		if playingSong.LastPlayedAt.Add(playingSong.Duration * time.Second).After(time.Now()) {
			err = tx.Commit()
			app.FailOnError(err, "Commit transaction")
			return
		} else {
			playingSong.IsPlaying = false
			err = playingSong.UpdateIsPlaying(tx)
			app.FailOnError(err, "Turning off playing song")
		}
	}
	msg, _, err := ch.Get(q.Name, false)
	app.FailOnError(err, "Get message from queue")
	if msg.Body != nil {
		err = handleNewSong(msg.Body, tx)
		app.FailOnError(err, "Handle new song")
		err = msg.Ack(true)
		app.FailOnError(err, "Ack message")
	}
	err = tx.Commit()
	app.FailOnError(err, "Commit transaction")
	err = ch.Close()
	app.FailOnError(err, "Close channel")
}

func handleNewSong(message []byte, tx *sql.Tx) (err error) {
	songBody := Song{}
	err = json.Unmarshal(message, &songBody)
	if err != nil {
		return err
	}
	songModel := models.Song{Id: songBody.Id}
	song, err := songModel.FindById(tx)
	if err != nil {
		return err
	}
	playingSong, err := models.FindPlaying(tx)
	if err != nil {
		return err
	}
	if playingSong != nil {
		playingSong.IsPlaying = false
		err = playingSong.UpdateIsPlaying(tx)
		if err != nil {
			return err
		}
	}
	song.IsPlaying = true
	song.LastPlayedAt = time.Now()
	err = song.UpdateIsPlaying(tx)
	if err != nil {
		return err
	}
	return nil
}
