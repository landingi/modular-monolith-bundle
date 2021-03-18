<?php
declare(strict_types=1);

namespace Landingi\Tests\ModularMonolithBundle\Fake\Module\Handler;

use Landingi\ModularMonolithBundle\Module\Message;
use Landingi\ModularMonolithBundle\Module\RequestHandler;

final class FakeRequestHandler implements RequestHandler
{
    private array $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    public function __invoke(Message $request): array
    {
        return $this->response;
    }
}
