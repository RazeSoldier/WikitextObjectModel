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

namespace RazeSoldier\WikitextObjectModel\Searcher;

use RazeSoldier\WikitextObjectModel\Element\{
    Page,
    Section
};

/**
 * 用于搜索Page实例里的一个Section实例
 * @package RazeSoldier\ArcRawToWiki\WikitextModel
 */
class SectionSearcher
{
    /**
     * @var Page 在这个实例搜索
     */
    private $haystack;

    public function __construct(Page $page)
    {
        $this->haystack = $page;
    }

    /**
     * 根据段落的名字来搜索
     * @note 注意：在同一页面下有多个相同名字的段落使用此方法会返回包含这些段落的数组
     * @param string $name
     * @return Section[]|null 返回包括找到的Section实例的数组，如果找不到则返回NULL
     */
    public function searchByName(string $name) :? array
    {
        $result = [];
        $index = $this->haystack->getSectionIndex();
        foreach ($index as $value) {
            if ($value['title'] === $name) {
                $result[] = $this->haystack->getStructure()[$value['position']];
            }
        }
        return $result;
    }

    /**
     * 根据段落的名字来搜索段落在页面的位置
     * @note 注意：在同一页面下有多个相同名字的段落使用此方法会返回包含这些段落的数组
     * @param string $name
     * @return int[]|null 返回包括找到的Section位置的数组，如果找不到则返回NULL
     */
    public function searchPosByName(string $name) :? array
    {
        $result = [];
        $index = $this->haystack->getSectionIndex();
        foreach ($index as $value) {
            if ($value['title'] === $name) {
                $result[] = $value['position'];
            }
        }
        return $result;
    }
}