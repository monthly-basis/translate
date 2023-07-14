<?php
namespace MonthlyBasis\Translate\Model\Service;

use MonthlyBasis\Memcached\Model\Service as MemcachedService;
use MonthlyBasis\Translate\Model\Table as TranslateTable;

class Translate
{
    protected string $language;

    public function __construct(
        protected MemcachedService\Memcached $memcachedService,
        protected TranslateTable\Translate $translateTable,
    ) {
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function translate(
        string $string,
        string $language = null
    ): string {
        if ($this->language == 'en') {
            return $string;
        }

        if (!isset($language)) {
            $language = $this->getLanguage();
        }

        $cacheKey = md5($_SERVER['DOCUMENT_ROOT'] . __METHOD__ . $language . $string);
        if (null !== ($translation = $this->memcachedService->get($cacheKey))) {
            return $translation;
        }

        $translation = $this->translateTable->selectLanguageWhereEn(
            $language,
            $string
        );

        $this->memcachedService->setForDays($cacheKey, $translation, 30);
        return $translation;
    }
}
