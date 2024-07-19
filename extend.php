<?php

/*
 * This file is part of foskym/flarum-multi-mailer.
 *
 * Copyright (c) 2023 FoskyM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace FoskyM\MultiMailer;

use Flarum\Extend;
use FoskyM\MultiMailer\Mail\MultiSmtpDriver;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Routes('api'))
        ->get('/multi-mailer', 'multi-mailer.list', Api\Controller\ListMailerController::class)
        ->post('/multi-mailer', 'multi-mailer.create', Api\Controller\CreateMailerController::class)
        ->patch('/multi-mailer/{id}', 'multi-mailer.update', Api\Controller\UpdateMailerController::class)
        ->delete('/multi-mailer/{id}', 'multi-mailer.delete', Api\Controller\DeleteMailerController::class),

    (new Extend\Mail())->driver('multi-smtp',MultiSmtpDriver::class)
];
