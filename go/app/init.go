package app

import (
	"database/sql"
	"fmt"
	"github.com/joho/godotenv"
	_ "github.com/lib/pq"
	"github.com/rabbitmq/amqp091-go"
	"log"
	"os"
)

var Connection *amqp091.Connection
var DataBase *sql.DB

func FailOnError(err error, msg string) {
	if err != nil {
		log.Printf("[!] Error! %s: %s", msg, err)
	}
}

func env() {
	//if err := godotenv.Load(".env", "./../.env"); err != nil {
	if err := godotenv.Load(".env"); err != nil {
		log.Print("No .env file found")
	}
}

func db() {
	dsn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable",
		"database", 5432, os.Getenv("POSTGRES_USER"), os.Getenv("POSTGRES_PASSWORD"), "fix_test")
	//dsn := fmt.Sprintf("host=%s port=%d user=%s password=%s dbname=%s sslmode=disable",
	//	"localhost", 5435, os.Getenv("POSTGRES_USER"), os.Getenv("POSTGRES_PASSWORD"), "fix_test")
	var err error
	DataBase, err = sql.Open("postgres", dsn)
	if err != nil {
		log.Fatalln(fmt.Errorf("failed initialize db. %s", err.Error()))
	}
	err = DataBase.Ping()
	if err != nil {
		log.Println(fmt.Errorf("failed ping db. %s", err.Error()))
	}
	log.Println("Database connection established")
}

func amqp() {
	var err error
	Connection, err = amqp091.Dial("amqp://guest:guest@amqp:5672/")
	//Connection, err = amqp091.Dial("amqp://guest:guest@localhost:5673/")
	FailOnError(err, "Failed init amqp")
	log.Println("AMQP connection established")
}

func Init() {
	env()
	db()
	amqp()
}
