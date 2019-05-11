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
 * 维基文本里模版的映射
 * @package RazeSoldier\ArcRawToWiki\WikitextModel
 */
class Template implements IElement
{
    /**
     * @var string 模版的名字
     */
    private $name;

    /**
     * @var array[] 模版的参数
     */
    private $params = [];

    /**
     * @var string 维基文本
     */
    private $wikitext;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * 往模版添加一个参数
     * @param string $key
     * @param $value
     */
    public function addParam(string $key, $value)
    {
        $this->params[] = [
            'key' => $key,
            'value' => $value
        ];
    }

    private function sync()
    {
        // 如果参数的数量大于3，则隔行一个参数
        $count = count($this->params);
        if ($count >= 3) {
            $text = "{{{$this->name}\n";
            foreach ($this->params as $i => $param) {
                $text .= "| {$param['key']} = {$param['value']}\n";
            }
            $text .= '}}';
            $this->wikitext = $text;
        } else {
            $text = "{{{$this->name}";
            foreach ($this->params as $i => $param) {
                $text .= "|{$param['key']} = {$param['value']}";
            }
            $text .= '}}';
            $this->wikitext = $text;
        }
    }

    public function getWikitext() : string
    {
        $this->sync();
        return $this->wikitext;
    }
}