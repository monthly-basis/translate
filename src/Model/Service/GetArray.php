<?php
namespace LeoGalleguillos\Translate\Model\Service;

use LeoGalleguillos\Translate\Model\Table as TranslateTable;

class GetArray
{
    public function __construct(
        TranslateTable\Translate $translateTable
    ) {
        $this->translateTable = $translateTable;
    }

    public function getArray(string $language): array {
        $array     = [];
        $generator = $this->translateTable->selectLanguage($language);

        foreach ($generator as $row) {
            $array[$row['en']] = $array[$row[$language]];
        }
        return $array;
    }
}
