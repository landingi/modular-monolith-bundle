<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module\Exception;

use Exception;

final class RequestRegistrationNotFoundException extends Exception
{
    public static function createForPath(string $path): self
    {
        return new self(sprintf('Request registration not found for path: %s', $path));
    }
}
