<?php

/*
 * This file is part of foskym/flarum-multi-mailer.
 *
 * Copyright (c) 2024 FoskyM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Flarum\Database\Migration;

return Migration::addColumns('multi_mailer', [
    'mail_suffix' => ['string', 'length' => 200, 'default' => null, 'nullable' => true],
    'mail_encryption' => ['string', 'length' => 200, 'default' => null, 'nullable' => true],
]);
