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

use RazeSoldier\WikitextObjectModel\Element\Page;
use PHPUnit\Framework\TestCase;
use RazeSoldier\WikitextObjectModel\Element\Section;

class PageTest extends TestCase
{
    /**
     * @var Page
     */
    private $page;

    public function setUp()
    {
        $page = new Page;
        $section1 = new Section('test', 2);
        $section2 = new Section('section2', 2);
        $page->addElement($section1);
        $page->addElement($section2);
        $this->page = $page;
    }

    public function testReplaceSection()
    {
        $section = new Section('section1', 2);
        $this->page->replaceSection($section, 0);
        $this->assertSame('section1', $this->page->getSectionIndex()[0]['title']);
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Invalid type
     */
    public function testAddElementThrowEx()
    {
        $page = new Page;
        $page->addElement(1);
    }
}
