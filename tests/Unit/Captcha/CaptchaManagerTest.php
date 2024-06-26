<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Unit\Captcha;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Xpressengine\Captcha\CaptchaManager;

class CaptchaManagerTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testCreateGoogleDriver()
    {
        [$app, $config] = $this->getMocks();
        $instance = new CaptchaManager($app);

        $mockReq = m::mock('Illuminate\Http\Request');
        $mockFE = m::mock('Xpressengine\Presenter\Html\FrontendHandler');

        $app->shouldReceive('offsetGet')->with('config')->andReturn($config);
        $app->shouldReceive('offsetGet')->with('request')->andReturn($mockReq);
        $app->shouldReceive('offsetGet')->with('xe.frontend')->andReturn($mockFE);

        $driver = $instance->createGoogleDriver();

        $this->assertInstanceOf('Xpressengine\Captcha\Services\GoogleRecaptcha', $driver);
    }

    public function testGetAndSetDefaultDriver()
    {
        [$app, $config] = $this->getMocks();
        $instance = new CaptchaManager($app);

        $app->shouldReceive('offsetGet')->with('config')->andReturn($config);

        //        $app->shouldReceive('offsetSet');

        $this->assertEquals('google', $instance->getDefaultDriver());

        $instance->setDefaultDriver('another');

        $this->assertEquals('another', $instance->getDefaultDriver());
    }

    private function getMocks()
    {
        return [
            m::mock('Xpressengine\Foundation\Application'),
            new DummyConfig([
                'captcha.driver' => 'google',
                'captcha.apis' => [
                    'google' => [
                        'siteKey' => 'site_key',
                        'secret' => 'secret_str',
                    ],
                    'another' => [
                        'siteKey' => 'another_site_key',
                        'secret' => 'another_secret_str',
                    ],
                ],
            ]),
        ];
    }
}

class DummyConfig implements \ArrayAccess
{
    private $arr;

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function offsetGet($name): mixed
    {
        return $this->arr[$name];
    }

    public function offsetSet($name, $value): void
    {
        $this->arr[$name] = $value;
    }

    public function offsetUnset($name): void
    {
        unset($this->arr[$name]);
    }

    public function offsetExists($name): bool
    {
        return isset($this->arr[$name]);
    }
}
