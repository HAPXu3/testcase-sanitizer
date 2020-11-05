<?php

declare(strict_types = 1);

namespace Tests;

use App\Handlers\BaseHandler;

class NullHandler extends BaseHandler
{
    public function handle($data)
    {
        if (!is_null($data)) {
            return new NullError;
        }

        return $data;
    }
}
