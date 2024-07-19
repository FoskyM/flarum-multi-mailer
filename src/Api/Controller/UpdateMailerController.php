<?php

namespace FoskyM\MultiMailer\Api\Controller;

use Flarum\Api\Controller\AbstractShowController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use FoskyM\MultiMailer\Model\MultiMailer;
use FoskyM\MultiMailer\Api\Serializer\MultiMailerSerializer;

class UpdateMailerController extends AbstractShowController
{
    public $serializer = MultiMailerSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertAdmin();

        $id = Arr::get($request->getQueryParams(), 'id');
        $mailer = MultiMailer::find($id);

        $attributes = Arr::get($request->getParsedBody(), 'data.attributes', []);

        collect(['mail_suffix', 'mail_from', 'mail_host', 'mail_password', 'mail_port', 'mail_username', 'mail_encryption'])
            ->each(function (string $attribute) use ($mailer, $attributes) {
                if (($val = Arr::get($attributes, $attribute)) !== null) {
                    $mailer->$attribute = $val;
                }
            });

        $mailer->save();

        return $mailer;
    }
}
