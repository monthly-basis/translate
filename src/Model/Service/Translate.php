<?php
namespace LeoGalleguillos\Translate\Model\Service;

use LeoGalleguillos\Translate\Model\Service as TranslateService;

class Translate
{
    protected $language;

    public function __construct(
        TranslateService\GetArray $getArrayService
    ) {
        $this->getArrayService = $getArrayService;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): TranslateService\Translate
    {
        $this->language = $language;
        return $this;
    }

    public function translate(
        string $string,
        string $language = null
    ): string {
        if ($language == 'en') {
            return $string;
        }

        if (!isset($language)) {
            $language = $this->getLanguage();
        }

        $array = $this->getArrayService->getArray($language);
        return $array[$string] ?? '';
    }
}
