<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use InvalidArgumentException;

final class GenericMessage implements Message
{
    private array $data;

    public function __construct(array $rawData = [])
    {
        $this->data = $rawData;
    }

    /**
     * @return mixed|null
     */
    private function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    /**
     * @return mixed
     */
    private function getRequired(string $key)
    {
        $value = $this->get($key);

        if (null === $value) {
            throw new InvalidArgumentException(sprintf('Property "%s" is required', $key));
        }

        return $value;
    }

    public function getString(string $key): string
    {
        return (string) $this->get($key);
    }

    public function getRequiredString(string $key): string
    {
        return $this->getRequired($key);
    }

    public function getInt(string $key): int
    {
        return (int) $this->get($key);
    }

    public function getRequiredInt(string $key): int
    {
        return (int) $this->getRequired($key);
    }

    public function getBool(string $key): bool
    {
        return (bool) $this->get($key);
    }

    public function getRequiredBool(string $key): bool
    {
        return (bool) $this->getRequired($key);
    }

    public function getFloat(string $key): float
    {
        return (float) $this->get($key);
    }

    public function getRequiredFloat(string $key): float
    {
        return (float) $this->getRequired($key);
    }

    public function getArray(string $key): array
    {
        return (array) $this->get($key);
    }

    public function getRequiredArray(string $key): array
    {
        return (array) $this->getRequired($key);
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
