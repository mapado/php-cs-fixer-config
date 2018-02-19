<?php

namespace Mapado\CS;

use PhpCsFixer\Config as CsFixerConfig;

final class Config extends CsFixerConfig
{
    private $useRisky;

    public function __construct($useRisky = true)
    {
        parent::__construct('Mapado');

        $this->setRiskyAllowed(true);
        $this->useRisky = $useRisky;
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
                '@PHP71Migration:risky' => $this->useRisky,
            ];
        }

        return $out;
    }
}
