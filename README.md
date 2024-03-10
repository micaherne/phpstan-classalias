# phpstan-classalias

This is an EXPERIMENTAL extension for PHPStan that adds support for static class aliases (i.e. those known before runtime).

It is intended to remove the need for using actual class_alias() calls in a bootstrap file, which requires the aliased class to be available (or at least autoloadable) at the time the alias is defined, otherwise PHP will emit a warning. 

## Installation

Add the extension to your `composer.json`. For example:

```json
{
    "require-dev": {
        "phpstan/phpstan": "^1.10",
        "phpstan/phpstan-classalias": "^0.1"
    }
}
```

Either install with [PHPStan Extension Installer](https://github.com/phpstan/extension-installer) or include the extension.neon file in your project's PHPStan config:

```neon
includes:
    - vendor/micaherne/phpstan-classalias/extension.neon
```

Configuration
-------------

The extension adds a single option to the `parameters` section of your PHPStan config file, `classAliases`. This is an array of class aliases, where the key is the alias and the value is the fully qualified class name.

For example:

```neon
parameters:
    classAliases:
        MyAlias: My\Namespace\MyClass
```

Status
------

This extension is experimental and uses an unpleasant hack to the container configuration to enable it to work. In addition, it uses a couple of parts of the PHPStan API that are not covered by the backward compatibility promise. 

As such, it is reasonably likely to break in future versions of PHPStan. (It was tested with PHPStan 1.10.60)

*It is not recommended for production use.*

