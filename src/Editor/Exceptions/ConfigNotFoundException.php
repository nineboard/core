<?php
/**
 * ConfigNotFoundException
 *
 * PHP version 7
 *
 * @category    Editor
 *
 * @author      XE Team (developers) <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        http://www.xpressengine.com
 */

namespace Xpressengine\Editor\Exceptions;

use Xpressengine\Editor\EditorException;

/**
 * ConfigNotFoundException
 *
 * @category    Editor
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class ConfigNotFoundException extends EditorException
{
    protected $message = '":instanceId" editor configuration cannot be found.';
}
