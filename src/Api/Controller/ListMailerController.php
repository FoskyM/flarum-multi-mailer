<?php

namespace FoskyM\MultiMailer\Api\Controller;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;
use FoskyM\MultiMailer\Model\MultiMailer;
use FoskyM\MultiMailer\Api\Serializer\MultiMailerSerializer;

class ListMailerController extends AbstractListController
{
    public $serializer = MultiMailerSerializer::class;
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertAdmin();

        return MultiMailer::all();
    }
}
