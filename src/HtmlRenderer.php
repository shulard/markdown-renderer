<?php

namespace MarkdownRenderer;

use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use Webuni\CommonMark\TableExtension\TableExtension;
use MarkdownRenderer\DocumentProcessor\ExternalLink;
use MarkdownRenderer\DocumentProcessor\TableClass;
use MarkdownRenderer\DocumentProcessor\MarkdownLink;
use MarkdownRenderer\DocumentProcessor\BlockquoteClass;

class HtmlRenderer
{
    private $converter;

    public function __construct()
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new TableExtension());
        $environment->addDocumentProcessor(new ExternalLink());
        $environment->addDocumentProcessor(new TableClass());
        $environment->addDocumentProcessor(new MarkdownLink());
        $environment->addDocumentProcessor(new BlockquoteClass());

        $this->converter = new CommonMarkConverter(
            [],
            $environment
        );
    }

    public function render(string $content): string
    {
        return $this->converter->convertToHtml($content);
    }
}
