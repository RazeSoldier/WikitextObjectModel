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

namespace RazeSoldier\WikitextModel\Test\Element;

use PHPUnit\Framework\TestCase;
use RazeSoldier\WikitextObjectModel\Element\Template;

class TemplateTest extends TestCase
{
    public static function data1Provider()
    {
        return '{{Test|Foo = 123|Var = OK}}';
    }

    public static function data2Provider()
    {
        return <<<TEXT
{{Test
| Foo = 123
| Var = OK
| 测试 = OK
| Arcaea = low
}}
TEXT;

    }

    public function testGetWikitextWithShort()
    {
        $template = new Template('Test');
        $template->addParam('Foo', 123);
        $template->addParam('Var', 'OK');
        $this->assertSame(self::data1Provider(), $template->getWikitext());
    }

    public function testGetWikitextWithLong()
    {
        $template = new Template('Test');
        $template->addParam('Foo', 123);
        $template->addParam('Var', 'OK');
        $template->addParam('测试', 'OK');
        $template->addParam('Arcaea', 'low');
        $this->assertSame(self::data2Provider(), $template->getWikitext());
    }
}
