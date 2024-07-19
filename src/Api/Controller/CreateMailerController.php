<?php

namespace FoskyM\MultiMailer\Api\Controller;

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use FoskyM\MultiMailer\Model\MultiMailer;
use FoskyM\MultiMailer\Api\Serializer\MultiMailerSerializer;

class CreateMailerController extends AbstractCreateController
{
    public $serializer = MultiMailerSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertAdmin();

        $attributes = Arr::get($request->getParsedBody(), 'data.attributes');

        return MultiMailer::create([
            'mail_suffix' => Arr::get($attributes, 'mail_suffix'),
            'mail_from' => Arr::get($attributes, 'mail_from'),
            'mail_host' => Arr::get($attributes, 'mail_host'),
            'mail_password' => Arr::get($attributes, 'mail_password'),
            'mail_port' => Arr::get($attributes, 'mail_port'),
            'mail_username' => Arr::get($attributes, 'mail_username'),
            'mail_encryption' => Arr::get($attributes, 'mail_encryption')
        ]);
    }
}
