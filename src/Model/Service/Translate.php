<?php
namespace LeoGalleguillos\Translate\Model\Service;

use LeoGalleguillos\Translate\Model\Service as TranslateService;

class Translate
{
    public function __construct(
        TranslateService\GetArray $getArrayService
    ) {
        $this->getArrayService = $getArrayService;
    }

    public function translate(
        string $string,
        string $language
    ) : string {
        $array = $this->getArrayService->getArray($language);
        return $array[$string] ?? '';
    }
}
