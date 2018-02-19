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
}
