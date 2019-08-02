<?php
namespace LeoGalleguillos\TranslateTest;

use LeoGalleguillos\Translate\Module;
use LeoGalleguillos\Test\ModuleTestCase;

class ModuleTest extends ModuleTestCase
{
    protected function setUp()
    {
        $this->module = new Module();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Module::class, $this->module);
    }
}
