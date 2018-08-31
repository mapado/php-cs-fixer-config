<?php

namespace Mapado\CS\Tests\Units;

use atoum;

class Config extends atoum
{
    public function testConfig()
    {
        $this
            ->if($this->newTestedInstance)
            ->then($rules = $this->testedInstance->getRules())
                ->array($rules)
                    ->isNotEmpty()
                ->boolean($rules['@PSR2'])
                    ->isTrue()
        ;
    }

    public function testRiskyRules()
    {
        $this
            ->if($this->newTestedInstance)
            ->then($rules = $this->testedInstance->getRules())
                ->boolean($rules['@PHP70Migration:risky'])
                    ->isTrue()

            ->if($this->newTestedInstance(false))
            ->then($rules = $this->testedInstance->getRules())
                ->boolean($rules['@PHP70Migration:risky'])
                    ->isFalse()
        ;
    }

    public function testExtraRules()
    {
        $this
            ->if($this->newTestedInstance(
                true,
                [
                    'visibility_required' => true,
                ]
            ))
            ->then($rules = $this->testedInstance->getRules())
                ->boolean($rules['visibility_required'])
                    ->isTrue()
        ;
    }

    public function testExtraRulesPosition()
    {
        $this
            ->if($this->newTestedInstance(
                true,
                [
                    '@Symfony' => false,
                    'visibility_required' => false,
                ]
            ))
            ->then($rules = $this->testedInstance->getRules())
                ->if($symfonyPosition = array_search('@Symfony', array_keys($rules)))
                    ->integer($symfonyPosition)
                        ->isEqualTo(1)

                ->then
                ->if($visiPosition = array_search('visibility_required', array_keys($rules)))
                    ->integer($visiPosition)
                        ->isEqualTo(13)
        ;
    }
}
