<?php

declare(strict_types=1);

namespace src\Application\Actions\Party;

use PhpAmqpLib\Message\AMQPMessage;
use Psr\Http\Message\ResponseInterface as Response;
use src\Application\Actions\Party\Models\SongMessage;

class StartAction extends BaseAction
{
    private const QUEUE_NAME = 'songs';

    protected function action(): Response
    {
        $channel = $this->amqpStreamConnection->channel();
        $channel->queue_declare(self::QUEUE_NAME, false, false, false, false);
        $songs = $this->songRepository->findAll();
        shuffle($songs);
        foreach ($songs as $song) {
            $message = new SongMessage(song: $song);
            $channel->basic_publish(
                new AMQPMessage(json_encode($message, JSON_UNESCAPED_UNICODE)),
                '',
                self::QUEUE_NAME
            );
        }
        $channel->close();
        return $this->response->withStatus(200);
    }
}
