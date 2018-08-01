<?php

namespace tests;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;


abstract class BookTestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     * @throws BadRequest400Exception
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $uri = $app->make('config')->get('app.url', 'http://localhost');

        $components = parse_url($uri);

        $server = $_SERVER;

        if (isset($components['path'])) {
            $server = array_merge($server, [
                'SCRIPT_FILENAME' => $components['path'],
                'SCRIPT_NAME' => $components['path'],
            ]);
        }

        $app->instance('request', Request::create(
            $uri, 'GET', [], [], [], $server
        ));

        return $app;
    }
}