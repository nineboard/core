<?php
/**
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Tests\Plugin\Sample;

use Xpressengine\Plugin\AbstractPlugin;

class PluginSample2 extends AbstractPlugin
{
    /**
     * @return bool
     */
    public function install()
    {
        // TODO: Implement install() method.
    }

    /**
     * @return bool
     */
    public function unInstall()
    {
        // TODO: Implement unInstall() method.
    }

    /**
     * @return bool
     */
    public function checkInstalled()
    {
        // TODO: Implement checkInstall() method.
        return false;
    }

    /**
     * @return bool
     */
    public function checkUpdated()
    {
        // TODO: Implement checkUpdate() method.
    }

    public function boot()
    {

    }
}
