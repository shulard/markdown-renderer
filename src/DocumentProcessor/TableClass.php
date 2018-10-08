<?php

namespace MarkdownRenderer\DocumentProcessor;

use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Block\Element\Document;
use Webuni\CommonMark\TableExtension\Table;

class TableClass implements DocumentProcessorInterface
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

            if (!($node instanceof Table) || !$event->isEntering()) {
                continue;
            }

            $node->data['attributes']['class'] = 'table table-dark';
        }
    }
}
