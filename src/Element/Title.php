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
 * 维基文本里标题的映射
 * @package RazeSoldier\ArcRawToWiki\WikitextModel
 */
class Title implements IElement
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $level;

    private $wikitext;

    public function __construct(string $text, string $level)
    {
        $this->text = $text;
        $this->level = $level;
    }

    private function sync()
    {
        $symbol = str_repeat('=', $this->level);
        $this->wikitext = "$symbol $this->text $symbol";
    }

    public function getWikitext() : string
    {
        if ($this->wikitext === null) {
            $this->sync();
        }
        return $this->wikitext;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }
}