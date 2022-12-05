<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/action', function (Group $group) {
        $group->get('', \App\Application\Actions\Action\ListAction::class);
        $group->delete('/{id}', \App\Application\Actions\Action\DeleteAction::class);
        $group->post('', \App\Application\Actions\Action\CreateAction::class);
    });

    $app->group('/guest', function (Group $group) {
        $group->get('', \App\Application\Actions\Guest\ListAction::class);
        $group->delete('/{id}', \App\Application\Actions\Guest\DeleteAction::class);
        $group->post('', \App\Application\Actions\Guest\CreateAction::class);
    });

    $app->group('/style', function (Group $group) {
        $group->get('', \App\Application\Actions\MusicStyle\ListAction::class);
        $group->delete('/{id}', \App\Application\Actions\Action\DeleteAction::class);
        $group->post('', \App\Application\Actions\Action\CreateAction::class);
    });

    $app->group('/dance', function (Group $group) {
        $group->get('', \App\Application\Actions\Dance\ListAction::class);
        $group->delete('/{id}', \App\Application\Actions\Dance\DeleteAction::class);
        $group->post('', \App\Application\Actions\Dance\CreateAction::class);
    });

    $app->group('/song', function (Group $group) {
        $group->get('', \App\Application\Actions\Action\ListAction::class);
        $group->delete('/{id}', \App\Application\Actions\Action\DeleteAction::class);
        $group->post('', \App\Application\Actions\Action\CreateAction::class);
    });
};
