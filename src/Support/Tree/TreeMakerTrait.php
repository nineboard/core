<?php
/**
 * This file is trait for tree makes.
 *
 * PHP version 7
 *
 * @category    Support
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Support\Tree;

/**
 * Trait TreeMakerTrait
 *
 * @category    Support
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
trait TreeMakerTrait
{
    /**
     * Make Tree instance
     *
     * @param  array  $nodes  node items
     * @return Tree
     */
    protected function makeTree($nodes = [])
    {
        return Tree::make($nodes);
    }
}
