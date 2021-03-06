<?php
namespace MonthlyBasis\Translate\Model\Service;

use MonthlyBasis\Memcached\Model\Service as MemcachedService;
use MonthlyBasis\Translate\Model\Table as TranslateTable;

class GetArray
{
    public function __construct(
        MemcachedService\Memcached $memcachedService,
        TranslateTable\Translate $translateTable
    ) {
        $this->memcachedService = $memcachedService;
        $this->translateTable   = $translateTable;
    }

    public function getArray(string $language): array {
        $cacheKey = md5(__METHOD__ . $language);
        if (null !== ($array = $this->memcachedService->get($cacheKey))) {
            return $array;
        }

        $array     = [];
        $generator = $this->translateTable->selectLanguage($language);

        foreach ($generator as $row) {
            $array[$row['en']] = $row[$language];
        }

        $this->memcachedService->setForDays($cacheKey, $array, 28);
        return $array;
    }
}
