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

require_once __DIR__ . '/../vendor/autoload.php';

define('ASSETS_DIR', __DIR__ . '/assets');

$phpUnitClass = 'PHPUnit\TextUI\Command';

if ( !class_exists( 'PHPUnit\\Framework\\TestCase' ) ) {
    echo "PHPUnit not found. Please install it and other dev dependencies by running `"
        . "composer install` in the root directory.\n";
    die ( 1 );
}
if ( !class_exists( $phpUnitClass ) ) {
    echo "PHPUnit entry point '" . $phpUnitClass . "' not found. Please make sure you installed "
        . "the containing component and check the spelling of the class name.\n";
    die ( 1 );
}

$_SERVER['argv'][] = '-c' . __DIR__ . '/phpunit.xml';
$phpUnitClass::main();