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
    Element\Section,
    Parser\TableParser,
    Test\Parser\TableParserTest
};

class SectionTest extends TestCase
{
    public function testGetWikitext()
    {
        $section = new Section('Test', 2);
        $section->addElement('This is a test.');
        $expected = "== Test ==\nThis is a test.\n";
        $this->assertSame($expected, $section->getWikitext());
    }

    /**
     * @depends testGetWikitext
     */
    public function testGetWikitextWithTable()
    {
        $section = new Section('Test', 2);
        $section->addElement('This is a test.');
        $parser = new TableParser(TableParserTest::dataProvider());
        $table = $parser->getResult();
        $section->addElement($table);
        $expected = <<<TEXT
== Test ==
This is a test.
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
|}

TEXT;
        $this->assertSame($expected, $section->getWikitext());
    }
}
