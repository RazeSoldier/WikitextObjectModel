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

namespace RazeSoldier\WikitextObjectModel\Test\Searcher;

use PHPUnit\Framework\TestCase;
use RazeSoldier\WikitextObjectModel\{
    Parser\PageParser,
    Searcher\SectionSearcher
};

class SectionSearcherTest extends TestCase
{
    /**
     * @var SectionSearcher
     */
    private $searcher;

    public static function dataProvider()
    {
        return file_get_contents(ASSETS_DIR . '/page_test.wikitext');
    }

    public function setUp()
    {
        $page = (new PageParser(self::dataProvider()))->getResult();
        $this->searcher = new SectionSearcher($page);
    }

    public function testSearchPosByName()
    {
        $this->assertSame([8], $this->searcher->searchPosByName('0-L'));
    }

    public function testSearchByName()
    {
        $this->assertSame("== 测试第二级标题 ==\nTest\n",$this->searcher->searchByName('测试第二级标题')[0]->getWikitext());
    }
}
