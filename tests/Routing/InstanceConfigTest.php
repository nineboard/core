<?php
/**
 * InstanceConfigTest
 *
 * PHP version 5
 *
 * @category    Test
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Tests\Routing;

use PHPUnit\Framework\TestCase;
use Xpressengine\Routing\InstanceConfig;

/**
 * Class InstanceRouteTest
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class InstanceConfigTest extends TestCase
{
    /**
     * testInstanceConfig
     *
     * @return void
     */
    public function testInstanceConfig()
    {
        /**
         * @var InstanceConfig $instanceConfig
         */
        $instanceConfig = InstanceConfig::instance();

        $instanceConfig->setInstanceId('test');
        $instanceConfig->setModule('module/xpressengine@board');
        $instanceConfig->setTheme('defaultTheme');
        $instanceConfig->setUrl('freeboard');

        $this->assertEquals('freeboard', $instanceConfig->getUrl());
        $this->assertEquals('module/xpressengine@board', $instanceConfig->getModule());
        $this->assertEquals('test', $instanceConfig->getInstanceId());
        $this->assertEquals('defaultTheme', $instanceConfig->getTheme());
    }
}
