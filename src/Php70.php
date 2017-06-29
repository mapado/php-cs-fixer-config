<?php

namespace Mapado\CS\Config;

use PhpCsFixer\Config;

final class Php70 extends Config
{
    public function __construct()
    {
        parent::__construct('Mapado (PHP 7.0)');

        $this->setRiskyAllowed(true);
    }

    public function getRules()
    {
        return [
            '@PSR2' => true,
            '@Symfony' => true,
            '@PHP70Migration' => true,
            'array_syntax' => [ 'syntax' => 'short' ],
            'concat_space' => [ 'spacing' => 'one' ],
            'phpdoc_align' => false,
            'phpdoc_summary' => false,
            'pow_to_exponentiation' => false,
            'random_api_migration' => false,
            'ordered_imports' => true,
            'ordered_class_elements' => true,
        ];
    }
}
