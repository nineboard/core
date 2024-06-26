<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Unit\Menu;

use Mockery as m;
use Xpressengine\Menu\MenuHandler;

class MenuHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testDeleteMenu()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $instance */
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['deleteMenuTheme'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        /** @var stdClass $collection */
        $collection = m::mock('stdClass');
        $collection->shouldReceive('count')->andReturn(0);

        /** @var \Xpressengine\Menu\Models\Menu $mockMenu */
        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('hasMacro')->andReturn(false);
        $mockMenu->shouldReceive('getAttribute')->with('items')->andReturn($collection);

        $instance->expects($this->once())->method('deleteMenuTheme');

        $menus->shouldReceive('delete')->with($mockMenu)->andReturn(true);

        $instance->deleteMenu($mockMenu);

        $this->assertTrue(true);
    }

    public function testRemoveThrowsExceptionWhenHasItem()
    {
        $this->expectException(\Xpressengine\Menu\Exceptions\CanNotDeleteMenuEntityHaveChildException::class);
        // $this->assertInstanceOf('Xpressengine\Menu\Exceptions\CanNotDeleteMenuEntityHaveChildException', $e);

        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $instance */
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['deleteMenuTheme'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $collection = m::mock('stdClass');
        $collection->shouldReceive('count')->andReturn(1);

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('hasMacro')->andReturn(false);
        $mockMenu->shouldReceive('getAttribute')->with('items')->andReturn($collection);

        $instance->deleteMenu($mockMenu);
    }

    public function testCreateItem()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $instance */
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['setHierarchy', 'setOrder', 'storeMenuType'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        /** @var \Xpressengine\Menu\Models\Menu $mockMenu */
        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu')->shouldAllowMockingProtectedMethods();
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getAggregatorKeyName')->andReturn('menuId');
        //        $mockMenuItem->shouldReceive('setAttribute')->once()->with('menuId', 'menuKey');

        $items->shouldReceive('createModel')->with()->andReturn($mockMenuItem);
        $items->shouldReceive('create')->once()->with([
            'parentId' => 'pid',
            'title' => 'test title',
            'url' => 'test_url',
            'ordering' => 1,
            'menuId' => 'menuKey',
        ])->andReturn($mockMenuItem);

        $instance->expects($this->once())->method('setHierarchy')->with($mockMenuItem);
        $instance->expects($this->once())->method('setOrder')->with($mockMenuItem);
        $instance->expects($this->once())->method('storeMenuType')->with($mockMenuItem, ['foo' => 'var']);

        $item = $instance->createItem($mockMenu, [
            'parentId' => 'pid',
            'title' => 'test title',
            'url' => 'test_url',
            'ordering' => 1,
        ], ['foo' => 'var']);

        $this->assertInstanceOf('Xpressengine\Menu\Models\MenuItem', $item);
    }

    public function testUpdateItem()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $instance */
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['updateMenuType'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        /** @var \Xpressengine\Menu\Models\MenuItem $mockMenuItem */
        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getParentIdName')->andReturn('parentId');
        $mockMenuItem->shouldReceive('getOriginal')->with('parentId')->andReturn('parent_id');
        $items->shouldReceive('update')->once()
            ->with($mockMenuItem, ['title' => 'test title', 'parentId' => 'parent_id'])->andReturn($mockMenuItem);

        $instance->expects($this->once())->method('updateMenuType')->with($mockMenuItem, ['foo' => 'var']);

        $instance->updateItem($mockMenuItem, ['title' => 'test title'], ['foo' => 'var']);

        $this->assertTrue(true);
    }

    public function testDeleteItem()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $mockMenuItem */
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['deleteMenuType'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        /** @var \Xpressengine\Menu\Models\MenuItem $mockMenuItem */
        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getDescendantCount')->andReturn(0);

        $items->shouldReceive('delete')->once()->with($mockMenuItem)->andReturn(true);

        $instance->expects($this->once())->method('deleteMenuType')->with($mockMenuItem);

        $instance->deleteItem($mockMenuItem);

        $this->assertTrue(true);
    }

    public function testDeleteItemThrowsExceptionWhenHasItem()
    {
        $this->expectException(\Xpressengine\Menu\Exceptions\CanNotDeleteMenuItemHaveChildException::class);

        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();

        /** @var \Xpressengine\Menu\MenuHandler $mockMenuItem */
        $instance = new MenuHandler($menus, $items, $configs, $modules, $routes);

        /** @var \Xpressengine\Menu\Models\MenuItem $mockMenuItem */
        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getDescendantCount')->andReturn(1);

        $instance->deleteItem($mockMenuItem);
    }

    public function testSetOrder()
    {
        $this->expectNotToPerformAssertions();

        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = new MenuHandler($menus, $items, $configs, $modules, $routes);

        $collection = m::mock('stdClass');
        $collection->shouldReceive('filter')->andReturn($collection);

        $mockMenuItemParent = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItemParent->shouldReceive('getChildren')->andReturn($collection);

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getParent')->andReturn($mockMenuItemParent);

        $collection->shouldReceive('slice')->once()->with(0, 1)->andReturnSelf();
        $collection->shouldReceive('merge')->once()->with([$mockMenuItem])->andReturnSelf();
        $collection->shouldReceive('slice')->once()->with(1)->andReturnSelf();
        $collection->shouldReceive('merge')->once()->with($collection)->andReturnSelf();

        $collection->shouldReceive('each')->once();

        $instance->setOrder($mockMenuItem, 1);
    }

    public function testMoveItem()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['unlinkHierarchy', 'linkHierarchy'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItem->shouldReceive('getParentIdName')->andReturn('parentId');
        $mockMenuItem->shouldReceive('hasMacro')->andReturn(false);
        $mockMenuItem->shouldReceive('getAttribute')->with('parentId')->andReturn('pid');
        $mockMenuItem->shouldReceive('getKey')->andReturn('itemKey');
        $mockMenuItem->shouldReceive('getAttribute')->with('menu')->andReturn($mockMenu);
        $mockMenuItem->shouldReceive('getAggregatorKeyName')->andReturn('menuId');
        $mockMenuItem->shouldReceive('setRelation')->with('menu', $mockMenu);

        $mockMenuItemNewParent = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockMenuItemNewParent->shouldReceive('hasMacro')->andReturn(false);
        $mockMenuItemNewParent->shouldReceive('getAttribute')->with('menu')->andReturn($mockMenu);
        $mockMenuItemNewParent->shouldReceive('getKey')->andReturn('pnid');

        $mockMenuItem->shouldReceive('setAttribute')->with('parentId', 'pnid');

        $mockMenuItemOldParent = m::mock('Xpressengine\Menu\Models\MenuItem');

        $items->shouldReceive('find')->once()->with('pid')->andReturn($mockMenuItemOldParent);
        $instance->expects($this->once())->method('unlinkHierarchy')->with($mockMenuItem, $mockMenuItemOldParent);

        $mockMenuItem->shouldReceive('setAttribute')->with('parentId', null);

        $instance->expects($this->once())->method('linkHierarchy')->with($mockMenuItem, $mockMenuItemNewParent);

        $items->shouldReceive('update')->once()->with($mockMenuItem, ['menuId' => 'menuKey'])->andReturn($mockMenuItem);
        $mockMenuItem->shouldReceive('hasMacro')->andReturn(false);
        $mockMenuItem->shouldReceive('getAttribute')->with('descendants')->andReturn([]);

        $items->shouldReceive('find')->once()->with('itemKey')->andReturn($mockMenuItem);

        $instance->moveItem($mockMenu, $mockMenuItem, $mockMenuItemNewParent);
    }

    public function testSetMenuTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $instance->expects($this->once())->method('menuKeyString')->with('menuKey')->willReturn('configMenuKey');

        $configs->shouldReceive('add')->once()->with('configMenuKey', [
            'desktopTheme' => 'theme1',
            'mobileTheme' => 'theme2',
        ]);

        $instance->setMenuTheme($mockMenu, 'theme1', 'theme2');

        $this->assertTrue(true);
    }

    public function testGetMenuTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $instance->expects($this->once())->method('menuKeyString')->with('menuKey')->willReturn('configMenuKey');

        $configs->shouldReceive('get')->once()->with('configMenuKey')->andReturn('config');

        $config = $instance->getMenuTheme($mockMenu);

        $this->assertEquals('config', $config);
    }

    public function testUpdateMenuTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $instance->expects($this->once())->method('menuKeyString')->with('menuKey')->willReturn('configMenuKey');

        $mockConfig = m::mock('Xpressengine\Config\ConfigEntity');
        $mockConfig->shouldReceive('set')->once()->with('desktopTheme', 'theme1');
        $mockConfig->shouldReceive('set')->once()->with('mobileTheme', 'theme2');

        $configs->shouldReceive('get')->once()->with('configMenuKey')->andReturn($mockConfig);

        $configs->shouldReceive('modify')->once()->with($mockConfig);

        $instance->updateMenuTheme($mockMenu, 'theme1', 'theme2');

        $this->assertTrue(true);
    }

    public function testDeleteMenuTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenu = m::mock('Xpressengine\Menu\Models\Menu');
        $mockMenu->shouldReceive('getKey')->andReturn('menuKey');

        $instance->expects($this->once())->method('menuKeyString')->with('menuKey')->willReturn('configMenuKey');

        $configs->shouldReceive('removeByName')->once()->with('configMenuKey');

        $instance->deleteMenuTheme($mockMenu);
    }

    public function testSetMenuItemTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');

        $instance->expects($this->once())->method('menuKeyString')->with($mockMenuItem)->willReturn('configMenuItemKey');

        $configs->shouldReceive('add')->once()->with('configMenuItemKey', [
            'desktopTheme' => 'theme1',
            'mobileTheme' => 'theme2',
        ]);

        $instance->setMenuItemTheme($mockMenuItem, 'theme1', 'theme2');

        $this->assertTrue(true);
    }

    public function testGetMenuItemTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');

        $instance->expects($this->once())->method('menuKeyString')->with($mockMenuItem)->willReturn('configMenuItemKey');

        $configs->shouldReceive('get')->once()->with('configMenuItemKey')->andReturn('config');

        $config = $instance->getMenuItemTheme($mockMenuItem);

        $this->assertEquals('config', $config);
    }

    public function testUpdateMenuItemTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');

        $instance->expects($this->once())->method('menuKeyString')->with($mockMenuItem)->willReturn('configMenuItemKey');

        $mockConfig = m::mock('Xpressengine\Config\ConfigEntity');
        $mockConfig->shouldReceive('set')->once()->with('desktopTheme', 'theme1');
        $mockConfig->shouldReceive('set')->once()->with('mobileTheme', 'theme2');

        $configs->shouldReceive('get')->once()->with('configMenuItemKey')->andReturn($mockConfig);

        $configs->shouldReceive('modify')->once()->with($mockConfig);

        $instance->updateMenuItemTheme($mockMenuItem, 'theme1', 'theme2');

        $this->assertTrue(true);
    }

    public function testDeleteMenuItemTheme()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockMenuItem = m::mock('Xpressengine\Menu\Models\MenuItem');

        $instance->expects($this->once())->method('menuKeyString')->with($mockMenuItem)->willReturn('configMenuItemKey');

        $configs->shouldReceive('removeByName')->once()->with('configMenuItemKey');

        $instance->deleteMenuItemTheme($mockMenuItem);

        $this->assertTrue(true);
    }

    public function testMoveItemConfig()
    {
        [$menus, $items, $configs, $modules, $routes] = $this->getMocks();
        $instance = $this->getMockBuilder(MenuHandler::class)
            ->onlyMethods(['menuKeyString'])
            ->setConstructorArgs([$menus, $items, $configs, $modules,  $routes])
            ->getMock();

        $mockBefore = m::mock('Xpressengine\Menu\Models\MenuItem');
        $mockAfter = m::mock('Xpressengine\Menu\Models\MenuItem');

        $map = [
            [$mockBefore, 'configBeforeKey'],
            [$mockAfter, 'configAfter.Key'],
        ];

        $instance->expects($this->any())->method('menuKeyString')->willReturnMap($map);

        $mockConfig = m::mock('Xpressengine\Config\ConfigEntity');

        $configs->shouldReceive('get')->once()->with('configBeforeKey')->andReturn($mockConfig);
        $configs->shouldReceive('move')->once()->with($mockConfig, 'configAfter');

        $instance->moveItemConfig($mockBefore, $mockAfter);

        $this->assertTrue(true);
    }

    private function invokedMethod($object, $methodName, $parameters = [])
    {
        $rfc = new \ReflectionClass($object);
        $method = $rfc->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    private function getMocks()
    {
        return [
            m::mock('Xpressengine\Menu\Repositories\MenuRepository'),
            m::mock('Xpressengine\Menu\Repositories\MenuItemRepository'),
            m::mock('Xpressengine\Config\ConfigManager'),
            m::mock('Xpressengine\Menu\ModuleHandler'),
            m::mock('Xpressengine\Routing\RouteRepository'),
        ];
    }
}
