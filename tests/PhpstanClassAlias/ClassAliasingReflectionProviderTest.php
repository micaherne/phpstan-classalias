<?php

namespace PhpstanClassAlias;

use Exception;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Reflection\ReflectionProvider\ReflectionProviderFactory;
use PHPStan\Testing\PHPStanTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use ReflectionClass;

#[CoversClass(ClassAliasingReflectionProvider::class)]
class ClassAliasingReflectionProviderTest extends PHPStanTestCase
{
    #[\Override] public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../../extension.neon', __DIR__ . '/ClassAliasingReflectionProviderTest.neon'];
    }

    public function testConfiguration(): void
    {

        // Can't use $this->createReflectionProvider() as it doesn't use the factory,
        // and returns the autowired ReflectionProvider class.
        $factory = $this->getContainer()->getByType(ReflectionProviderFactory::class);
        $provider = $factory->create();

        $thisClass = $provider->getClass(self::class);
        $this->assertEquals(self::class, $thisClass->getName());

        $aliasClass = $provider->getClass('MyAlias');
        $this->assertEquals(Exception::class, $aliasClass->getName());
    }
}