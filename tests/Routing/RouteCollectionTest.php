<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Xpressengine\Routing\RouteCollection;

/**
 * Class RouteCollectionTest
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class RouteCollectionTest extends TestCase
{
    protected $route;

    protected $routeCollection;

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown()
    {
        m::close();
    }

    /**
     * testRouteAddLookup
     *
     * @return void
     */
    public function testRouteAddLookup()
    {
        /**
         * @var RouteCollection $collection;
         */
        $route = m::mock('Illuminate\Routing\Route');

        $route->shouldReceive('getDomain')->andReturn('http://xe3.dev');
        $route->shouldReceive('uri')->andReturn('/');
        $route->shouldReceive('methods')->andReturn(['get']);

        $route->shouldReceive('getAction')->andReturn([
            'as' => 'test.root.match',
            'module' => 'module/pluginB@page',
            'controller' => 'UserController@index',
            'settings_menu' => 'setting_1',
        ]);

        $collection = new RouteCollection();

        $collection->add($route);

        $sourceRoute = $collection->getByModule('module/pluginB@page');
        $settingMenuRoutes = $collection->getSettingsMenuRoutes();

        $this->assertEquals('http://xe3.dev', $sourceRoute->getDomain());
        $this->assertEquals('/', $sourceRoute->uri());
        $this->assertEquals(['get'], $sourceRoute->methods());

        $this->assertEquals(1, count($settingMenuRoutes));
        $this->assertEquals($route, $settingMenuRoutes[0]);

        m::close();
    }

    /**
     * testRouteAddLookupNoSource
     *
     * @return void
     */
    public function testRouteAddLookupNoSource()
    {
        /**
         * @var RouteCollection $collection;
         */
        $route = m::mock('Illuminate\Routing\Route');

        $route->shouldReceive('getDomain')->andReturn('http://xe3.dev');
        $route->shouldReceive('uri')->andReturn('/');
        $route->shouldReceive('methods')->andReturn(['get']);

        $route->shouldReceive('getAction')->andReturn([
            'as' => 'test.root.match',
            'controller' => 'UserController@index',
        ]);

        $collection = new RouteCollection();

        $collection->add($route);

        $sourceRoute = $collection->getByName('test.root.match');

        $this->assertEquals('http://xe3.dev', $sourceRoute->getDomain());
        $this->assertEquals('/', $sourceRoute->uri());
        $this->assertEquals(['get'], $sourceRoute->methods());

        m::close();
    }

    /**
     * setUp
     */
    protected function setUp(): void
    {
        /**
         * @var Route $route
         * @var Request $request
         */
        parent::setUp();
    }
}
