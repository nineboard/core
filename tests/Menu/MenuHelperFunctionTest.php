<?php
/**
 * MenuHelperFunctionTest class
 *
 * PHP version 5
 *
 * @category  Test
 *
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Menu;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Xpressengine\Routing\InstanceConfig;

/**
 * MenuHelperFunctionTest
 *
 * @category Menu
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class MenuHelperFunctionTest extends TestCase
{
    /**
     * tearDown
     */
    public function tearDown(): void
    {
        m::close();
    }

    public function testGetCurrentInstanceId()
    {
        /**
         * @var InstanceConfig $instanceConfig
         */
        $instanceConfig = InstanceConfig::instance();
        $instanceConfig->setInstanceId('testInstanceId');

        $instanceId = current_instance_id();

        $this->assertEquals('testInstanceId', $instanceId);
    }

    /**
     * setUp
     */
    public function setUp(): void
    {

    }
}
