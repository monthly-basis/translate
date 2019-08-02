<?php
namespace LeoGalleguillos\Translate;

use LeoGalleguillos\Translate\Model\Factory as TranslateFactory;
use LeoGalleguillos\Translate\Model\Service as TranslateService;
use LeoGalleguillos\Translate\Model\Table as TranslateTable;
use LeoGalleguillos\Translate\View\Helper as TranslateHelper;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'translate' => TranslateHelper\Translate::class,
                ],
                'factories' => [
                    TranslateHelper\Translate::class => function ($sm) {
                        return new TranslateHelper\Translate(
                            $sm->get(TranslateService\Translate::class)
                        );
                    },
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                TranslateService\Translate::class => function ($sm) {
                    return new TranslateService\Translate(
                        $sm->get(TranslateTable\Translate::class)
                    );
                },
                TranslateTable\Translate::class => function ($serviceManager) {
                    return new TranslateTable\Translate(
                        $serviceManager->get('translate')
                    );
                },
            ],
        ];
    }
}
