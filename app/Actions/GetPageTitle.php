<?php

namespace App\Actions\Yahoo\GetPageTitle;

use App\Actions\Api;
use App\Jobs\TestSelenium;

use Lorisleiva\Actions\Concerns\AsAction;

class GetPageTitle extends Api
{

    use AsAction;

    public static function routes($router)
    {
        $router->prefix('api')->get('get_title', static::class);
    }
    
    public function handle(){

        logger('IN Action');

        TestSelenium::dispatch();

        logger('After job dispatch');
    }


    public function jsonResponse($result, $request)
    {
        return [
            'message' => 'GetPageTitle',
            'data' => 'back from action'
        ];
    }
}