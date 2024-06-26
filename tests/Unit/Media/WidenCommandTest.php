<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Unit\Media;

use Mockery as m;
use Xpressengine\Media\Commands\WidenCommand;

class WidenCommandTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testGetName()
    {
        $instance = new WidenCommand();

        $this->assertEquals('widen', $instance->getName());
    }

    public function testGetMethod()
    {
        $instance = new WidenCommand();

        $this->assertEquals('widen', $instance->getMethod());
    }

    public function testGetExecArgs()
    {
        $instance = new WidenCommand();

        $dimension = m::mock('Xpressengine\Media\Coordinators\Dimension');
        $dimension->shouldReceive('getWidth')->andReturn(200);

        $instance->setDimension($dimension);

        $this->assertEquals([200], $instance->getExecArgs());
    }
}
