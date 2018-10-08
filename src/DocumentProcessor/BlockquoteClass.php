<?php

namespace MarkdownRenderer\DocumentProcessor;

use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\BlockQuote;

class BlockquoteClass implements DocumentProcessorInterface
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

            if (!($node instanceof BlockQuote) || !$event->isEntering()) {
                continue;
            }

            $node->data['attributes']['class'] = 'blockquote';
        }
    }
}
