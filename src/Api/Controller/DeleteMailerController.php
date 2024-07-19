<?php

namespace FoskyM\MultiMailer\Api\Controller;

use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use FoskyM\MultiMailer\Model\MultiMailer;
use FoskyM\MultiMailer\Api\Serializer\MultiMailerSerializer;

class DeleteMailerController extends AbstractDeleteController
{
    public $serializer = MultiMailerSerializer::class;
    protected function delete(ServerRequestInterface $request)
    {
        $id = Arr::get($request->getQueryParams(), 'id');
        RequestUtil::getActor($request)
            ->assertAdmin();

        $mailer = MultiMailer::find($id);

        $mailer->delete();
    }
}
