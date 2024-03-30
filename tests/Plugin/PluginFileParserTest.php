<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Plugin;

use Xpressengine\Plugin\PluginFileParser;

class PluginFileParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var PluginFileParser
     */
    protected $parser;

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    protected function setUp(): void
    {
        $this->parser = new PluginFileParser();

        parent::setUp(); // TODO: Change the autogenerated stub

    }

    public function testGetClassName()
    {

        $file = __DIR__.'/plugins/plugin_sample/plugin.php';
        $class = $this->parser->getClassName($file);

        $this->assertEquals($class, 'Xpressengine\Tests\Plugin\Sample\PluginSample');

        $file = __DIR__.'/plugins/plugin_sample2/plugin.php';

        $class = $this->parser->getClassName($file);

        $this->assertEquals($class, 'Xpressengine\Tests\Plugin\Sample\PluginSample2');
    }

    public function testGetPluginInfoByComment()
    {
        $file = __DIR__.'/plugins/plugin_sample/plugin.php';
        $info = $this->parser->getPluginInfoByComment($file);

        $this->assertEquals(count($info), 6);

        $this->assertEquals($info['Name'], '플러그인명');
        $this->assertEquals($info['Version'], '3.0.2.2');
    }
}
