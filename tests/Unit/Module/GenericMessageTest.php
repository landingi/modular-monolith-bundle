<?php
declare(strict_types=1);

namespace Landingi\Tests\ModularMonolithBundle\Module;

use InvalidArgumentException;
use Landingi\ModularMonolithBundle\Module\GenericMessage;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class GenericMessageTest extends TestCase
{
    private GenericMessage $exampleMessage;

    public function setUp(): void
    {
        $this->exampleMessage = new GenericMessage([
            'test-string' => 'string',
            'test-bool' => true,
            'test-int' => 5,
            'test-float' => 2.5,
            'test-array' => ['example' => 'array'],
        ]);
    }

    public function testGettingString(): void
    {
        assertEquals('string', $this->exampleMessage->getString('test-string'));
        assertEquals('string', $this->exampleMessage->getRequiredString('test-string'));
    }

    public function testThrowsExceptionOnMissingRequiredStringProperty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->exampleMessage->getRequiredString('missing-property');
    }

    public function testGettingInt(): void
    {
        assertEquals(5, $this->exampleMessage->getInt('test-int'));
        assertEquals(5, $this->exampleMessage->getRequiredInt('test-int'));
    }

    public function testThrowsExceptionOnMissingRequiredIntProperty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->exampleMessage->getRequiredInt('missing-property');
    }

    public function testGettingBool(): void
    {
        assertEquals(true, $this->exampleMessage->getBool('test-bool'));
        assertEquals(true, $this->exampleMessage->getRequiredBool('test-bool'));
    }

    public function testThrowsExceptionOnMissingRequiredBoolProperty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->exampleMessage->getRequiredBool('missing-property');
    }

    public function testGettingFloat(): void
    {
        assertEquals(2.5, $this->exampleMessage->getFloat('test-float'));
        assertEquals(2.5, $this->exampleMessage->getRequiredFloat('test-float'));
    }

    public function testThrowsExceptionOnMissingRequiredFloatProperty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->exampleMessage->getRequiredFloat('missing-property');
    }

    public function testGettingArray(): void
    {
        assertEquals(['example' => 'array'], $this->exampleMessage->getArray('test-array'));
        assertEquals(['example' => 'array'], $this->exampleMessage->getRequiredArray('test-array'));
    }

    public function testThrowsExceptionOnMissingRequiredArrayProperty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->exampleMessage->getRequiredArray('missing-property');
    }

    public function testGettingAll(): void
    {
        assertEquals([
            'test-string' => 'string',
            'test-bool' => true,
            'test-int' => 5,
            'test-float' => 2.5,
            'test-array' => ['example' => 'array'],
        ], $this->exampleMessage->getAll());
    }
}
