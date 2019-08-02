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

    public function getArray(): array {
        $array = [];
        foreach ($this->translateTable->select() as $row) {
            $array[$row['en']] = [
                'es' => $row['es'],
                'fr' => $row['fr'],
            ];
        }
        return $array;
    }
}
