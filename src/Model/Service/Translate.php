<?php
namespace LeoGalleguillos\Translate\Model\Service;

use LeoGalleguillos\Translate\Model\Table as TranslateTable;

class Translate
{
    public function __construct(
        TranslateTable\Translate $translateTable
    ) {
        $this->translateTable = $translateTable;
    }

    public function translate(
        string $string,
        string $language
    ) : string {
        return $array[$string][$language] ?? '';
    }
}
