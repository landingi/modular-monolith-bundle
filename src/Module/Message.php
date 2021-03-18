<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use JsonSerializable;

interface Message extends JsonSerializable
{
    public function getString(string $key): string;
    public function getRequiredString(string $key): string;

    public function getInt(string $key): int;
    public function getRequiredInt(string $key): int;

    public function getBool(string $key): bool;
    public function getRequiredBool(string $key): bool;

    public function getFloat(string $key): float;
    public function getRequiredFloat(string $key): float;

    public function getArray(string $key): array;
    public function getRequiredArray(string $key): array;

    public function getAll(): array;
}
