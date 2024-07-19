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

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasTable('multi_mailer')) {
            return;
        }
        $schema->getConnection()->table('multi_mailer')->insert([
            'mail_suffix' => '*',
            'mail_from' => '',
            'mail_host' => '',
            'mail_password' => '',
            'mail_port'    =>  '465',
            'mail_username'    =>  '',
            'mail_encryption'    =>  'ssl',
        ]);
    },
    'down' => function (Builder $schema) {

    },
];
