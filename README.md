# phpstan-classalias

This is an EXPERIMENTAL extension for PHPStan that adds support for static class aliases (i.e. those known before runtime).

## Installation

Add the extension to your `composer.json`. For example:

```json
{
    "require-dev": {
        "phpstan/phpstan": "^0.12.3",
        "phpstan/phpstan-classalias": "^0.1"
    }
}
```

Either install with [PHPStan Extension Installer](https://github.com/phpstan/extension-installer) or include the extension.neon file in your project's PHPStan config:

```neon
includes:
    - vendor/phpstan/phpstan-classalias/extension.neon
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

