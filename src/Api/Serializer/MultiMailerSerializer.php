<?php

namespace FoskyM\MultiMailer\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use FoskyM\MultiMailer\Model\MultiMailer;
use InvalidArgumentException;

class MultiMailerSerializer extends AbstractSerializer
{
    protected $type = 'multi-mailer';

    protected function getDefaultAttributes($model)
    {
        if (!($model instanceof MultiMailer)) {
            throw new InvalidArgumentException(
                get_class($this) . ' can only serialize instances of ' . MultiMailer::class
            );
        }

        // See https://docs.flarum.org/extend/api.html#serializers for more information.

        return [
            "id" => $model->id,
            "mail_suffix" => $model->mail_suffix,
            "mail_from" => $model->mail_from,
            "mail_host" => $model->mail_host,
            "mail_password" => $model->mail_password,
            "mail_port" => $model->mail_port,
            "mail_username" => $model->mail_username,
            "mail_encryption" => $model->mail_encryption
        ];
    }
}
