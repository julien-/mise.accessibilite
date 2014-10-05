<?php
// +--------------------------------------------------------------------------+
// | Image_Graph aka GraPHPite                                                |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2003, 2004 Jesper Veggerby Hansen                          |
// | Email         pear.nosey@veggerby.dk                                |
// | Web           http://graphpite.sourceforge.net                           |
// | PEAR          http://pear.php.net/pepr/pepr-proposal-show.php?id=145     |
// +--------------------------------------------------------------------------+
// | This library is free software; you can redistribute it and/or            |
// | modify it under the terms of the GNU Lesser General Public               |
// | License as published by the Free Software Foundation; either             |
// | version 2.1 of the License, or (at your option) any later version.       |
// |                                                                          |
// | This library is distributed in the hope that it will be useful,          |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU        |
// | Lesser General Public License for more details.                          |
// |                                                                          |
// | You should have received a copy of the GNU Lesser General Public         |
// | License along with this library; if not, write to the Free Software      |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA |
// +--------------------------------------------------------------------------+

/**
 * Image_Graph aka GraPHPite - PEAR PHP OO Graph Rendering Utility.
 * @package fillstyle
 * @copyright Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license http://www.gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @author Jesper Veggerby Hansen <pear.nosey@veggerby.dk>
 * @version $Id: Constants.php,v 1.3 2004/11/05 19:13:30 nosey Exp $
 */ 

/**
 * Defines a horizontal gradient fill
 */
define("IMAGE_GRAPH_GRAD_HORIZONTAL", 1);

/**
 * Defines a vertical gradient fill
 */
define("IMAGE_GRAPH_GRAD_VERTICAL", 2);

/**
 * Defines a horizontally mirrored gradient fill
 */
define("IMAGE_GRAPH_GRAD_HORIZONTAL_MIRRORED", 3);

/**
 * Defines a vertically mirrored gradient fill
 */
define("IMAGE_GRAPH_GRAD_VERTICAL_MIRRORED", 4);

/**
 * Defines a diagonal gradient fill from top-left to bottom-right
 */
define("IMAGE_GRAPH_GRAD_DIAGONALLY_TL_BR", 5);

/**
 * Defines a diagonal gradient fill from bottom-left to top-right
 */
define("IMAGE_GRAPH_GRAD_DIAGONALLY_BL_TR", 6);

/**
 * Defines a radial gradient fill
 */
define("IMAGE_GRAPH_GRAD_RADIAL", 7);

?>