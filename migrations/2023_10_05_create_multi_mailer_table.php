<?php

/*
 * This file is part of foskym/flarum-multi-mailer.
 *
 * Copyright (c) 2023 FoskyM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('multi_mailer')) {
            return;
        }
        $schema->create('multi_mailer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail_from', 200)->nullable();
            $table->string('mail_host', 200)->nullable();
            $table->string('mail_password', 200)->nullable();
            $table->string('mail_port', 40)->nullable();
            $table->string('mail_username', 200)->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('multi_mailer');
    },
];
