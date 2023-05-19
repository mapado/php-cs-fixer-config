CHANGELOG
===========

## 3.0.1 - 2023-05-19

- Make PSR12 / PER explicit and fix short closure issue [#2](https://github.com/mapado/php-cs-fixer-config/pull/2)

## 3.0.0 - 2023-05-04

- Added php8.1 support
- Upgrade php-cs-fixer to 3.16.0

## 3.0.0 - 2020-12-08

- Default to all "Migration" rules, fallback for older version of PHP. It might break if php-cs-fixer changes the list of function in PHPXXMigration and that new rule needs a version of PHP that is not handled
- Upgrade php-cs-fixer to 2.17.0

## 2.1.3 - 2018-08-31

### Changed

Fix issue with items position

## 2.1.2 - 2018-03-01

### Changed

fix issue when ListSyntaxFixer does not exists (SF <3.0)

## 2.1.1 - 2018-03-1

### Changed

remove @PHP71Migration:risky as only void_return differ from PHP70Migration:risky

## 2.1.0 - 2018-02-27

### Added

Add a possibility to set extra rule set. Only undefined rules will be set

### Changed

  * Set `void_return` to `false`
  * Set `simplified_null_return` to `true`
  * Set `list_syntax` to "short"

## 2.0.3 - 2018-02-20

Allow using Symfony 2.x by lowering php-cs-fixer dependency

## 2.0.2 - 2018-02-19

Fixed issue with autoloading

## 2.0.1 - 2018-02-19 [Yanked]

Fixed issue with autoloading

## 2.0.0 - 2018-02-19 [Yanked]

### Added 

Support for PHP 7.1 and 7.2

## Changed

[Breaking] The classname changed from `Mapado\CS\Config\Php70` to `Mapado\Cs\Config`

## 1.0.0

Initial version, compatible with php 7
