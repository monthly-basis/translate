<?php
namespace LeoGalleguillos\Translate\View\Helper;

use LeoGalleguillos\Translate\Model\Entity as TranslateEntity;
use LeoGalleguillos\Translate\Model\Service as TranslateService;
use Zend\View\Helper\AbstractHelper;

class Translate extends AbstractHelper
{
    public function __construct(
        TranslateService\Translate $translateService
    ) {
        $this->translateService = $translateService;
    }

    public function __invoke(
        string $string,
        string $language
    ) {
        return $this->translateService->translate(
            $string,
            $language
        );
    }
}
