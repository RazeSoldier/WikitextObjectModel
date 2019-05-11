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

class InternalLink implements IElement
{
    /**
     * @var string
     */
    private $dst;

    /**
     * @var string|null
     */
    private $showText;

    public function __construct(string $dst, string $showText = null)
    {
        $this->dst = $dst;
        $this->showText = $showText;
    }

    public function getWikitext() : string
    {
        $raw = "[[{$this->dst}";
        if ($this->showText === null) {
            $raw .= ']]';
        } else {
            $raw .= "|{$this->showText}]]";
        }
        return $raw;
    }
}