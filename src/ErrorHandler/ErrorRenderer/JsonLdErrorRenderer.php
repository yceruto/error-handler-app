<?php

namespace App\ErrorHandler\ErrorRenderer;

use Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class JsonLdErrorRenderer implements ErrorRendererInterface
{
    private $debug;

    /**
     * {@inheritdoc}
     */
    public static function getFormat(): string
    {
        return 'jsonld';
    }

    public function __construct(bool $debug = true)
    {
        $this->debug = $debug;
    }

    /**
     * {@inheritdoc}
     */
    public function render(FlattenException $exception): string
    {
        $content = [
            '@id' => 'https://example.com',
            '@type' => 'error',
            '@context' => [
                'title' => $exception->getTitle(),
                'code' => $exception->getStatusCode(),
                'message' => $exception->getMessage(),
            ],
        ];
        if ($this->debug) {
            $content['@context']['exceptions'] = $exception->toArray();
        }

        return json_encode($content);
    }
}
