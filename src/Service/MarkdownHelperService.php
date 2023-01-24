<?php

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelperService
{
    public function __construct(
        private MarkdownParserInterface $parser,
        private CacheInterface          $cache
    )
    {
    }

    public function parseQuestion(string $text): string
    {
        return $this->cache->get('question-' . md5($text), function (CacheItemInterface $cacheItem) use ($text) {
            $cacheItem->expiresAfter(60);
            return $this->parser->transformMarkdown($text);
        });
    }
}