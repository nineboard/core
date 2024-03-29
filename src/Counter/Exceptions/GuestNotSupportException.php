<?php
/**
 * GuestNotSupportException
 *
 * PHP version 7
 *
 * @category    Document
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Counter\Exceptions;

use Xpressengine\Counter\CounterException;

/**
 * GuestNotSupportException
 *
 * @category    Counter
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class GuestNotSupportException extends CounterException
{
    protected $message = '":name" counter not support "Guest"';
}
