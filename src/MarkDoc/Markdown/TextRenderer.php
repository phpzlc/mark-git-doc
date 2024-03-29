<?php

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPZlc\MarkGitDoc\MarkDoc\Markdown;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\Xml;

final class TextRenderer implements InlineRendererInterface
{
    /**
     * @param Text                     $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Text)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . \get_class($inline));
        }

        $slug = $inline->getContent();
        
        foreach (MarkdownParser::$params as $key => $value){
            if(strpos($slug, $key) !== false && (strpos($slug, $value) !== false)){
                return  '';
            }
        }

        return Xml::escape($inline->getContent());
    }
}
