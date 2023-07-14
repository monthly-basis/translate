<?php
namespace MonthlyBasis\TranslateTest\Model\Table;

use Exception;
use MonthlyBasis\Translate\Model\Table as TranslateTable;
use MonthlyBasis\LaminasTest\TableTestCase;
use Laminas\Db\Adapter\Exception\InvalidQueryException;

class TranslateTest extends TableTestCase
{
    protected function setUp(): void
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

    public function testSelectLanguage()
    {
        try {
            $generator = $this->translateTable->selectLanguage('invalid');
            $array     = iterator_to_array($generator);
            $this->fail();
        } catch (Exception $exception) {
            $this->assertSame(
                'Invalid language.',
                $exception->getMessage()
            );
        }

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

        $generator = $this->translateTable->selectLanguage('es');
        $array     = iterator_to_array($generator);

        $this->assertCount(
            4,
            $array
        );
        $this->assertCount(
            2,
            $array[3]
        );
        $this->assertSame(
            $array[0]['en'],
            'homework'
        );
        $this->assertSame(
            $array[0]['es'],
            'tarea'
        );
        $this->assertSame(
            $array[2]['en'],
            'Algebra'
        );
        $this->assertSame(
            $array[2]['es'],
            'Álgebra'
        );

        $generator = $this->translateTable->selectLanguage('fr');
        $array     = iterator_to_array($generator);

        $this->assertSame(
            $array[2]['fr'],
            'Algèbre'
        );
        $this->assertSame(
            $array[3]['fr'],
            'mathématiques'
        );
    }

    public function test_selectLanguageWhereEn()
    {
        $result = $this->translateTable->selectLanguageWhereEn(
            'es',
            'Ask a New Question'
        );
        $this->assertEmpty(iterator_to_array($result));
    }
}
