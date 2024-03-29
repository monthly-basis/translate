<?php
namespace MonthlyBasis\Translate;

use MonthlyBasis\Memcached\Model\Service as MemcachedService;
use MonthlyBasis\Translate\Model\Factory as TranslateFactory;
use MonthlyBasis\Translate\Model\Service as TranslateService;
use MonthlyBasis\Translate\Model\Table as TranslateTable;
use MonthlyBasis\Translate\View\Helper as TranslateHelper;

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
                TranslateService\GetArray::class => function ($sm) {
                    return new TranslateService\GetArray(
                        $sm->get(MemcachedService\Memcached::class),
                        $sm->get(TranslateTable\Translate::class)
                    );
                },
                TranslateService\Translate::class => function ($sm) {
                    return new TranslateService\Translate(
                        $sm->get(MemcachedService\Memcached::class),
                        $sm->get(TranslateTable\Translate::class),
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
