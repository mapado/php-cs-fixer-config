# CHANGELOG

## 5.0.0

- upgrade php-cs-fixer to 3.91. Allow PHP 8.2 [#7](https://github.com/mapado/php-cs-fixer-config/pull/7) by [@jdeniau](https://github.com/jdeniau)

## 4.2.1

- Fix another conflicts with prettier [#6](https://github.com/mapado/php-cs-fixer-config/pull/6) by [@jdeniau](https://github.com/jdeniau)

## 4.2.0

- Add an option to disable prettier-handled rules [#5](https://github.com/mapado/php-cs-fixer-config/pull/5) by [@jdeniau](https://github.com/jdeniau)

## 4.1.0

- Prefer prettier over Symfony style [#4](https://github.com/mapado/php-cs-fixer-config/pull/4) by [@jdeniau](https://github.com/jdeniau)

## 4.0.0

- [BREAKING] Upgrade PHP-CS-Fixer and configuration [#3](https://github.com/mapado/php-cs-fixer-config/pull/3).
  Requires `"friendsofphp/php-cs-fixer": "^3.60"`

## 3.2.1 - 2023-05-19

- Make PSR12 / PER explicit and fix short closure issue [#2](https://github.com/mapado/php-cs-fixer-config/pull/2)

## 3.2.0 - 2023-05-05

- upgrade php8 package

## 3.1.1 - 2023-05-05

- 3.16 require doctrine/annotation > 2, ticketing is not ready for that

## 3.1.0 - 2023-05-04

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

- Set `void_return` to `false`
- Set `simplified_null_return` to `true`
- Set `list_syntax` to "short"

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
