<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace RazeSoldier\WikitextObjectModel\Element;

/**
 * 维基文本里段落的映射
 * @package RazeSoldier\ArcRawToWiki\WikitextModel
 */
class Section implements IElement
{
    /**
     * @var Title 段落的标题
     */
    private $title;

    /**
     * @var string 表格的wikitext
     */
    private $wikitext;

    /**
     * @var array 段落的结构
     */
    private $structure;

    public function __construct(string $title, int $level)
    {
        $this->title = new Title($title, $level);
        $this->structure[] = $this->title;
    }

    /**
     * 添加元素到段落里
     * @param IElement|string $element
     */
    public function addElement($element)
    {
        if ($element instanceof IElement || is_string($element)) {
            $this->structure[] = $element;
        } else {
            throw new \LogicException('Invalid type');
        }
    }

    /**
     * 根据当前的结构重新生成段落wikitext
     */
    private function sync()
    {
        $text = '';
        foreach ($this->structure as $line => $element) {
            if ($element instanceof IElement) {
                $text .= $element->getWikitext() . "\n";
                continue;
            }
            $text .= "$element\n";
        }
        $this->wikitext = $text;
    }

    public function getWikitext() : string
    {
        if ($this->wikitext === null) {
            $this->sync();
        }
        return $this->wikitext;
    }

    /**
     * @return Title
     */
    public function getTitle() : Title
    {
        return $this->title;
    }
}