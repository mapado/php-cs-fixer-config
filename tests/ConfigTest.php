<?php

namespace Mapado\CS\Tests\Units;

use Mapado\CS\Config;
use PHPUnit\Framework\TestCase;

/**
 * @covers Config
 */
class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $config = new Config();
        $rules = $config->getRules();
        $this->assertNotEmpty($rules);
        $this->assertTrue($rules['@PER-CS']);
    }

    public function testRiskyRules()
    {
        $config = new Config();
        $rules = $config->getRules();
        $this->assertTrue($rules['@PHP70Migration:risky']);

        $config = new Config(false);
        $rules = $config->getRules();
        $this->assertFalse($rules['@PHP70Migration:risky']);
    }

    public function testExtraRules()
    {
        $config = new Config(true, [
            'visibility_required' => true,
        ]);
        $rules = $config->getRules();
        $this->assertTrue($rules['visibility_required']);
    }

    public function testExtraRulesPosition()
    {
        $config = new Config(true, [
            '@Symfony' => false,
            'visibility_required' => false,
        ]);
        $rules = $config->getRules();
        $symfonyPosition = array_search('@Symfony', array_keys($rules));
        $this->assertEquals(0, $symfonyPosition);
        $visiPosition = array_search('visibility_required', array_keys($rules));
        $this->assertEquals(32, $visiPosition);
    }
}
