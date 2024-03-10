<?php declare(strict_types=1);

namespace PhpstanClassAlias;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Reflection\GlobalConstantReflection;
use PHPStan\Reflection\NamespaceAnswerer;
use PHPStan\Reflection\ReflectionProvider;

final class ClassAliasingReflectionProvider implements ReflectionProvider
{

    /**
     * @param array<string, string> $classAliases
     */
    public function __construct(private ReflectionProvider $reflectionProvider, private array $classAliases)
    {
    }

    #[\Override] public function hasClass(string $className): bool
    {
        if (array_key_exists($className, $this->classAliases)) {
            return $this->reflectionProvider->hasClass($this->classAliases[$className]);
        }
        return $this->reflectionProvider->hasClass($className);
    }

    #[\Override] public function getClass(string $className): ClassReflection
    {
        if (array_key_exists($className, $this->classAliases)) {
            return $this->reflectionProvider->getClass($this->classAliases[$className]);
        }
        return $this->reflectionProvider->getClass($className);
    }

    #[\Override] public function getClassName(string $className): string
    {
        if (array_key_exists($className, $this->classAliases)) {
            return $this->classAliases[$className];
        }
        return $this->reflectionProvider->getClassName($className);
    }

    #[\Override] public function supportsAnonymousClasses(): bool
    {
        return $this->reflectionProvider->supportsAnonymousClasses();
    }

    #[\Override] public function getAnonymousClassReflection(
        Node\Stmt\Class_ $classNode,
        Scope $scope,
    ): ClassReflection {
        return $this->reflectionProvider->getAnonymousClassReflection($classNode, $scope);
    }

    #[\Override] public function hasFunction(Node\Name $nameNode, ?NamespaceAnswerer $namespaceAnswerer): bool
    {
        return $this->reflectionProvider->hasFunction($nameNode, $namespaceAnswerer);
    }

    #[\Override] public function getFunction(
        Node\Name $nameNode,
        ?NamespaceAnswerer $namespaceAnswerer
    ): FunctionReflection {
        return $this->reflectionProvider->getFunction($nameNode, $namespaceAnswerer);
    }

    #[\Override] public function resolveFunctionName(
        Node\Name $nameNode,
        ?NamespaceAnswerer $namespaceAnswerer
    ): ?string {
        return $this->reflectionProvider->resolveFunctionName($nameNode, $namespaceAnswerer);
    }

    #[\Override] public function hasConstant(Node\Name $nameNode, ?NamespaceAnswerer $namespaceAnswerer): bool
    {
        return $this->reflectionProvider->hasConstant($nameNode, $namespaceAnswerer);
    }

    #[\Override] public function getConstant(
        Node\Name $nameNode,
        ?NamespaceAnswerer $namespaceAnswerer
    ): GlobalConstantReflection {
        return $this->reflectionProvider->getConstant($nameNode, $namespaceAnswerer);
    }

    #[\Override] public function resolveConstantName(
        Node\Name $nameNode,
        ?NamespaceAnswerer $namespaceAnswerer
    ): ?string {
        return $this->reflectionProvider->resolveConstantName($nameNode, $namespaceAnswerer);
    }
}