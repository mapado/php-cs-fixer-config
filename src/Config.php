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
            'array_syntax' => [ 'syntax' => 'short' ],
            'concat_space' => [ 'spacing' => 'one' ],
            'phpdoc_align' => false,
            'phpdoc_summary' => false,
            'ordered_imports' => true,
            'ordered_class_elements' => true,
        ];

        if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
            $out += [
                '@PHP71Migration' => true,
                'simplified_null_return' => true,
                'list_syntax' => [ 'syntax' => 'short' ],
            ];
        }

        return $this->extraRules + $out;
    }
}
