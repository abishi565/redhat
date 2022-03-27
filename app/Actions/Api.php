<?php

namespace App\Actions;

use Lorisleiva\Actions\Action;

class Api extends Action
{
    public function authorize()
    {
        return auth()->check();
    }

    public function middleware()
    {
        return ['api', 'auth:sanctum'];
    }
}
