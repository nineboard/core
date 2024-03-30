<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\DynamicField;

use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Class ColumnEntityTest
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class ColumnEntityTest extends TestCase
{
    /**
     * tear down
     */
    public function tearDown(): void
    {
        m::close();
    }

    /**
     * test column entity
     *
     * @return void
     */
    public function testColumnEntity()
    {
        $this->expectNotToPerformAssertions();

        $fluent = m::mock('Illuminate\Support\Fluent');
        $fluent->shouldReceive('nullable');
        $fluent->shouldReceive('unsigned');
        $fluent->shouldReceive('default');

        $table = m::mock('Illuminate\Database\Schema\Blueprint');
        $table->shouldReceive(\Xpressengine\DynamicField\ColumnDataType::STRING)->andReturn($fluent);
        $table->shouldReceive('dropColumn');

        $column = (new \Xpressengine\DynamicField\ColumnEntity(
            'data',
            \Xpressengine\DynamicField\ColumnDataType::STRING
        ))->setParams([255]);

        $column->setUnsigned();
        $column->setNullAble();
        $column->setDefault('');
        $column->setDescription('');
        $column->add($table);
        $column->drop($table);
    }
}
