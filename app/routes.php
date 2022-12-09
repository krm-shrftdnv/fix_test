<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use src\Application\Actions\User\ListUsersAction;
use src\Application\Actions\User\ViewUserAction;

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
        $group->get('', \src\Application\Actions\Action\ListAction::class);
        $group->delete('/{id}', \src\Application\Actions\Action\DeleteAction::class);
        $group->post('', \src\Application\Actions\Action\CreateAction::class);
    });

    $app->group('/guest', function (Group $group) {
        $group->get('', \src\Application\Actions\Guest\ListAction::class);
        $group->delete('/{id}', \src\Application\Actions\Guest\DeleteAction::class);
        $group->post('', \src\Application\Actions\Guest\CreateAction::class);
    });

    $app->group('/style', function (Group $group) {
        $group->get('', \src\Application\Actions\Style\ListAction::class);
        $group->delete('/{id}', \src\Application\Actions\Action\DeleteAction::class);
        $group->post('', \src\Application\Actions\Action\CreateAction::class);
    });

    $app->group('/dance', function (Group $group) {
        $group->get('', \src\Application\Actions\Dance\ListAction::class);
        $group->delete('/{id}', \src\Application\Actions\Dance\DeleteAction::class);
        $group->post('', \src\Application\Actions\Dance\CreateAction::class);
    });

    $app->group('/song', function (Group $group) {
        $group->get('', \src\Application\Actions\Action\ListAction::class);
        $group->delete('/{id}', \src\Application\Actions\Action\DeleteAction::class);
        $group->post('', \src\Application\Actions\Action\CreateAction::class);
    });

    $app->group('/party', function (Group $group) {
        $group->get('', \src\Application\Actions\Party\IndexAction::class);
        $group->get('/start', \src\Application\Actions\Party\StartAction::class);
    });
};
