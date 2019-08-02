<?php
namespace LeoGalleguillos\TranslateTest\Model\Table;

use LeoGalleguillos\Translate\Model\Table as TranslateTable;
use LeoGalleguillos\Test\TableTestCase;

class TranslateTest extends TableTestCase
{
    protected function setUp()
    {
        $this->translateTable = new TranslateTable\Translate(
            $this->getAdapter()
        );

        $this->dropTable('translate');
        $this->createTable('translate');
    }

    public function testInsert()
    {
        $translateId = $this->translateTable->insert(
            'science',
            'ciencia',
            'science'
        );
        $this->assertSame(1, $translateId);

        $translateId = $this->translateTable->insert(
            'Science',
            'Ciencia',
            'Science'
        );
        $this->assertSame(2, $translateId);
    }
}
