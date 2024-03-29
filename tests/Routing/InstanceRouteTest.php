<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Routing;

use PHPUnit\Framework\TestCase;
use Xpressengine\Routing\InstanceRoute;

/**
 * Class InstanceRouteTest
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class InstanceRouteTest extends TestCase
{
    /**
     * testInstanceRoute
     *
     * @return void
     */
    public function testInstanceRoute()
    {
        $instanceRoute = new InstanceRoute(
            [
                'instanceId' => 'board',
                'module' => 'module/xpressengine@board',
                'url' => 'freeboard',
                'menuId' => 'basic',
                'site' => 'default',
            ]
        );

        $this->assertEquals('freeboard', $instanceRoute->url);
        $this->assertEquals('module/xpressengine@board', $instanceRoute->module);
        $this->assertEquals('board', $instanceRoute->instanceId);
        $this->assertEquals('basic', $instanceRoute->menuId);
        $this->assertEquals('default', $instanceRoute->site);
    }
}
