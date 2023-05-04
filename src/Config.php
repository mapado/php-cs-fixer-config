<?php

namespace Mapado\CS;

use PhpCsFixer\Config as CsFixerConfig;

final class Config extends CsFixerConfig
{
    private $useRisky;

    private $extraRules;

    public function __construct($useRisky = true, array $extraRules = [])
    {
        parent::__construct('Mapado');

        $this->setRiskyAllowed(true);
        $this->useRisky = $useRisky;
        $this->extraRules = $extraRules;
    }

    public function getRules()
    {
        $out = [
            '@PSR2' => true,
            '@Symfony' => true,
            '@PHP70Migration' => true,
            '@PHP70Migration:risky' => $this->useRisky,

            // only `visibility_required` rule
            // https://cs.symfony.com/doc/ruleSets/PHP71Migration.html
            '@PHP71Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP73Migration.html
            '@PHP73Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP74Migration.html
            '@PHP74Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP74MigrationRisky.html
            '@PHP74Migration:risky' => $this->useRisky,

            // https://cs.symfony.com/doc/ruleSets/PHP80Migration.html
            '@PHP80Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP81Migration.html
            '@PHP81Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP80MigrationRisky.html
            '@PHP80Migration:risky' => $this->useRisky,

            // PHP arrays should be declared using the configured syntax.
            // Force short array syntax (`[]` over `array()`)
            // https://cs.symfony.com/doc/rules/array_notation/array_syntax.html
            'array_syntax' => ['syntax' => 'short'],

            // Concatenation should be spaced according configuration.
            // Force one space around concatenation dots
            // https://cs.symfony.com/doc/rules/operator/concat_space.html
            'concat_space' => ['spacing' => 'one'],

            // All items of the given phpdoc tags must be either left-aligned or (by default) aligned vertically.
            // Remove this rule enabled by @Symfony
            // https://cs.symfony.com/doc/rules/phpdoc/phpdoc_align.html
            'phpdoc_align' => false,

            // PHPDoc summary should end in either a full stop, exclamation mark, or question mark.
            // Remove this rule enabled by @Symfony
            // https://cs.symfony.com/doc/rules/phpdoc/phpdoc_summary.html
            'phpdoc_summary' => false,

            // Ordering `use` statements
            // https://cs.symfony.com/doc/rules/import/ordered_imports.html
            'ordered_imports' => true,

            // Orders the elements of classes/interfaces/traits.
            // https://cs.symfony.com/doc/rules/class_notation/ordered_class_elements.html
            'ordered_class_elements' => true,

            // remove this Symfony rule. See https://github.com/FriendsOfPHP/PHP-CS-Fixer/issues/3988.
            // https://cs.symfony.com/doc/rules/function_notation/single_line_throw.html
            'single_line_throw' => false,

            // A return statement wishing to return void should not return null.
            // https://cs.symfony.com/doc/rules/return_notation/simplified_null_return.html
            'simplified_null_return' => true,


            // List (array destructuring) assignment should be declared using the configured syntax.
            // https://cs.symfony.com/doc/rules/list_notation/list_syntax.html
            'list_syntax' => ['syntax' => 'short'],
        ];

        if (version_compare(PHP_VERSION, '7.1.0', '<')) {
            $out += [
                // as PHP 7.0 can not have visibility on `const`
                'visibility_required' => ['elements' => ['method', 'property']],
            ];
        }

        // do not use array_merge or `+` to put new key at the end
        foreach ($this->extraRules as $key => $value) {
            $out[$key] = $value;
        }

        return $out;
    }
}
