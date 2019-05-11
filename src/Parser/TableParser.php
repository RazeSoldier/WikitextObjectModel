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

namespace RazeSoldier\WikitextObjectModel\Parser;

use RazeSoldier\WikitextObjectModel\Element\Table;

/**
 * 用于解析表格代码（wikitext）
 * @package RazeSoldier\ArcRawToWiki\WikitextModel
 */
class TableParser
{
    private $text;

    /**
     * @var Table
     */
    private $table;

    public function __construct($text)
    {
        $this->text = $text;
        $this->parse();
    }

    private function parse()
    {
        preg_match("/(?<table>{\|.*\n(.|\n)*\|})/", $this->text, $matches);
        $table = explode("\n", $matches['table']);
        $tableObj = new Table();
        $columnHead = [];
        $i = 0;
        foreach ($table as $line => $text) {
            // 捕捉表格样式
            if ($line === 0) {
                preg_match('/{\|\s*(?<style>.*)\s*/', $text, $matches);
                $tableObj->setTableStyle($matches['style']);
                continue;
            }
            // 排除表格的最后一行
            if ($line === count($table) - 1) {
                continue;
            }
            // 并且排除空行
            if ($text === '') {
                continue;
            }
            // 捕捉列标题
            if (strpos($text, '!') !== false) {
                preg_match('/!\s*(?<text>[\w|\W]*)/', $text, $matches);
                $text = $matches['text'];
                $columnHead[] = $text;
                continue;
            }
            // 捕捉行开始
            if (strpos($text, '|-') !== false) {
                $i++;
                continue;
            }
            // 捕捉行内容 @{
            if (preg_match('/\|(.(?!\-)).*/', $text) === 1) {
                preg_match('/\|\s*(?<text>[\w|\W]*)/', $text, $matches);
                $rows[$i][] = $matches['text'];
                continue;
            }
            $text = end($rows[$i]) . "\n$text";
            $rows[$i][key($rows[$i])] = $text;
            // @}
        }
        $tableObj->setColumnHead($columnHead);
        $tableObj->setLines($rows);
        $this->table = $tableObj;
    }

    public function getResult() : Table
    {
        return $this->table;
    }
}