<?php
namespace LeoGalleguillos\Translate\Model\Service;

use LeoGalleguillos\Translate\Model\Table as TranslateTable;

class Array
{
    public function __construct(
        TranslateTable\Translate $translateTable
    ) {
        $this->translateTable = $translateTable;
    }

    public function getArray(): array {
        $this->translateTable->select();
        return [];
    }
}
