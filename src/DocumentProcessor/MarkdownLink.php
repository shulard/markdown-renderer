<?php

namespace MarkdownRenderer\DocumentProcessor;

use League\CommonMark\Block\Element\Document;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\DocumentProcessorInterface;

class MarkdownLink implements DocumentProcessorInterface
{
    /**
     * @param Document $document
     *
     * @return void
     */
    public function processDocument(Document $document)
    {
        $walker = $document->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            // Only stop at Link nodes when we first encounter them
            if (!($node instanceof Link) || !$event->isEntering()) {
                continue;
            }

            $url = $node->getUrl();
            $length = mb_strlen($url);
            if (strpos($url, '.md') === $length - 3) {
                $node->setUrl(substr($url, 0, $length - 3).'.html');
            }
        }
    }
}
