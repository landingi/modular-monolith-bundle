<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module\Exception;

use Exception;

final class RequestRegistrationAlreadyExistsException extends Exception
{
    public static function createForPath(string $path): self
    {
        return new self(sprintf('Request registration already exists for path: %s', $path));
    }
}
