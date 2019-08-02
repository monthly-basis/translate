<?php
namespace LeoGalleguillos\TranslateTest\Model\Table;

use LeoGalleguillos\Translate\Model\Table as TranslateTable;
use LeoGalleguillos\Test\TableTestCase;
use Zend\Db\Adapter\Exception\InvalidQueryException;

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

    public function testInsertAndSelectCount()
    {
        $translateId = $this->translateTable->insert(
            'science',
            'ciencia',
            'science'
        );
        $this->assertSame(
            1,
            $translateId
        );
        $this->assertSame(
            1,
            $this->translateTable->selectCount()
        );

        $translateId = $this->translateTable->insert(
            'Science',
            'Ciencia',
            'Science'
        );
        $this->assertSame(2, $translateId);
        $this->assertSame(
            2,
            $this->translateTable->selectCount()
        );

        try {
            $translateId = $this->translateTable->insert(
                'science',
                'ciencia',
                'science'
            );
            $this->fail();
        } catch (InvalidQueryException $invalidQueryException) {
            $this->assertSame(
                'Statement could not be executed',
                substr($invalidQueryException->getMessage(), 0, 31)
            );
        }
    }

    public function testSelect()
    {
        $generator = $this->translateTable->select();
        $this->assertEmpty(iterator_to_array($generator));

        $this->translateTable->insert(
            'homework',
            'tarea',
            'devoirs'
        );
        $this->translateTable->insert(
            'Contact Us',
            'Contáctenos',
            'Contactez-nous'
        );
        $this->translateTable->insert(
            'Algebra',
            'Álgebra',
            'Algèbre'
        );
        $this->translateTable->insert(
            'mathematics',
            'matemáticas',
            'mathématiques'
        );

        $generator = $this->translateTable->select();
        $array = iterator_to_array($generator);

        $this->assertSame(
            $array[0]['translate_id'],
            '1'
        );
        $this->assertSame(
            $array[0]['en'],
            'homework'
        );
        $this->assertSame(
            $array[1]['es'],
            'Contáctenos'
        );
        $this->assertSame(
            $array[2]['fr'],
            'Algèbre'
        );
        $this->assertSame(
            $array[3]['en'],
            'mathematics'
        );
        $this->assertSame(
            $array[3]['es'],
            'matemáticas'
        );
        $this->assertSame(
            $array[3]['fr'],
            'mathématiques'
        );
    }
}
