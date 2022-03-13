<?php
namespace MonthlyBasis\Translate\View\Helper;

use MonthlyBasis\Translate\Model\Entity as TranslateEntity;
use MonthlyBasis\Translate\Model\Service as TranslateService;
use Laminas\View\Helper\AbstractHelper;

class Translate extends AbstractHelper
{
    public function __construct(
        TranslateService\Translate $translateService
    ) {
        $this->translateService = $translateService;
    }

    public function __invoke(
        string $string,
        string $language = null
    ) {
        return $this->translateService->translate(
            $string,
            $language
        );
    }
}
