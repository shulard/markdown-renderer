<?php

namespace MarkdownRenderer\DocumentProcessor;

use League\CommonMark\Block\Element\Document;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\DocumentProcessorInterface;

class ExternalLink implements DocumentProcessorInterface
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
            if ($this->isUrlExternal($url)) {
                $node->data['attributes']['class'] = 'external-link';
                $node->data['attributes']['target'] = '_blank';
            }
        }
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    private function isUrlExternal($url)
    {
        // Only look at http and https URLs
        if (!preg_match('/^https?:\/\//', $url)) {
            return false;
        }
        return true;
    }
}
