<?php

namespace Mapado\CS;

use PhpCsFixer\Config as CsFixerConfig;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

final class Config extends CsFixerConfig
{
    private $useRisky;

    private $extraRules;

    private bool $disablePrettierRules;

    public function __construct($useRisky = true, array $extraRules = [], bool $disablePrettierRules = false)
    {
        parent::__construct('Mapado');

        $this->setParallelConfig(ParallelConfigFactory::detect());

        $this->setRiskyAllowed(true);
        $this->useRisky = $useRisky;
        $this->extraRules = $extraRules;
        $this->disablePrettierRules = $disablePrettierRules;
    }

    public function getRules(): array
    {
        $out = [
            '@Symfony' => true,
            '@PER-CS' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP8x2Migration.html
            '@PHP8x2Migration' => true,

            // https://cs.symfony.com/doc/ruleSets/PHP8x2MigrationRisky.html
            '@PHP8x2Migration:risky' => $this->useRisky,

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

            // Replace non multibyte-safe functions with corresponding mb function.
            // https://cs.symfony.com/doc/rules/alias/mb_str_functions.html
            'mb_str_functions' => false, // TODO activate this back when on PHP 8.4 $this->useRisky,

            // Add curly braces to indirect variables to make them clear to understand.
            // https://cs.symfony.com/doc/rules/language_construct/explicit_indirect_variable.html
            'explicit_indirect_variable' => true,

            // Add leading \ before function invocation to speed up resolving.
            // https://cs.symfony.com/doc/rules/function_notation/native_function_invocation.html
            'native_function_invocation' => false,

            // Imports or fully qualifies global classes/functions/constants.
            // Reset Symfony value
            // https://cs.symfony.com/doc/rules/import/global_namespace_import.html
            'global_namespace_import' => false,

            'nullable_type_declaration' => true,

            // Removes @param, @return and @var tags that don’t provide any useful information.
            // Comparing to Symfony, do not remove mixed
            // https://cs.symfony.com/doc/ruleSets/Symfony.html
            'no_superfluous_phpdoc_tags' => [
                // 'allow_hidden_params' => true, // TODO activate this when available
                'remove_inheritdoc' => true,
                'allow_mixed' => true,
            ],

            // Operators - when multiline - must always be at the beginning or at the end of the line.
            // Not explicitly set in PER, use the prettier version instead of Symfony's one
            // https://cs.symfony.com/doc/rules/operator/operator_linebreak.html
            'operator_linebreak' => [
                'only_booleans' => true,
                'position' => 'end',
            ],

            // Ensures a single space after language constructs.
            // Comparing to Symfony let prettier handle `as` like it wants
            // https://cs.symfony.com/doc/rules/language_construct/single_space_around_construct.html
            'single_space_around_construct' => [
                'constructs_preceded_by_a_single_space' => ['use_lambda'],
            ],

            // === Doctrine ===

            // Rules covering Doctrine annotations with configuration based on examples found in Doctrine Annotation documentation and Symfony documentation.
            // https://cs.symfony.com/doc/ruleSets/DoctrineAnnotation.html
            '@DoctrineAnnotation' => version_compare(PHP_VERSION, '7.0.0', '>='),

            // Fixes spaces in Doctrine annotations.
            // Default in `@DoctrineAnnotation` is `['before_array_assignments_colon' => false]`
            // https://cs.symfony.com/doc/rules/doctrine_annotation/doctrine_annotation_spaces.html
            'doctrine_annotation_spaces' => [
                'before_array_assignments_colon' => false,
                'around_parentheses' => false,
            ],

            // Doctrine annotations must use configured operator for assignment in arrays.
            // Default in `@DoctrineAnnotation` is `['operator' => ':']`
            // https://cs.symfony.com/doc/rules/doctrine_annotation/doctrine_annotation_array_assignment.html
            'doctrine_annotation_array_assignment' => [
                'operator' => '=',
            ],
        ];

        if (version_compare(PHP_VERSION, '7.1.0', '<')) {
            $out += [
                // as PHP 7.0 can not have visibility on `const`
                'visibility_required' => ['elements' => ['method', 'property']],
            ];
        }

        if ($this->disablePrettierRules) {
            $out = array_merge($out, [
                'class_definition' => false,
                'statement_indentation' => false,
                'no_unneeded_control_parentheses' => false,
                'no_multiline_whitespace_around_double_arrow' => false,
                'types_spaces' => false, // not that clear in PER
                'single_space_around_construct' => false,
                'method_argument_space' => false,
                'integer_literal_case' => false,
                'heredoc_indentation' => [
                    'indentation' => 'same_as_start',
                ],
            ]);
        }

        // do not use array_merge or `+` to put new key at the end
        foreach ($this->extraRules as $key => $value) {
            $out[$key] = $value;
        }

        return $out;
    }
}
