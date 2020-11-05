<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\PhoneError;

class PhoneHandler extends BaseHandler
{
    protected const PHONE_PATTERN = '/(\+7|8)\s\([0-9]{3}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}/';

    public function handle($data)
    {
        if (!is_string($data) || (preg_match(self::PHONE_PATTERN, $data) !== 1)) {
            return new PhoneError;
        }

        if (substr($data, 0, 1) === '8') {
            $data = '7' . substr($data, 1);
        }

        return preg_replace('/[^0-9]/', '', $data);
    }
}
