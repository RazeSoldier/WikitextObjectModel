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

namespace RazeSoldier\WikitextObjectModel\Test\Element;

use PHPUnit\Framework\TestCase;
use RazeSoldier\WikitextObjectModel\{
    Parser\TableParser,
    Test\Parser\TableParserTest
};

class TableTest extends TestCase
{
    public function testAddLine()
    {
        $parser = new TableParser(TableParserTest::dataProvider());
        $table = $parser->getResult();

        $table->addLine([1, 2, 3]);
        $this->assertSame([
            1 => ['待', '填', '坑', ''],
            2 => ['A', 'B', 'C', "D\nABC"],
            3 => [1, 2, 3]
        ], $table->getLines());

        $table->addLine([4, 5, 6], 2);
        $this->assertSame([
            1 => ['待', '填', '坑', ''],
            2 => [4, 5, 6],
            3 => ['A', 'B', 'C', "D\nABC"],
            4 => [1, 2, 3]
        ], $table->getLines());
    }

    public function testSync()
    {
        $parser = new TableParser(TableParserTest::dataProvider());
        $table = $parser->getResult();
        $table->addLine([1, 2, 3]);

        $expected = <<<TEXT
{| class="wikitable mw-collapsible mw-collapsed" border="1" cellspacing="0" cellpadding="5" style="text-align:center"
! 级数
! 步数
! 限制
! 奖励
|-
| 待
| 填
| 坑
| 
|-
| A
| B
| C
| D
ABC
|-
| 1
| 2
| 3
|}
TEXT;

        $this->assertSame($expected, $table->getWikitext());
    }
}
