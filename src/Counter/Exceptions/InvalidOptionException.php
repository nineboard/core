<?php
/**
 * InvalidOptionException
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
 * InvalidOptionException
 *
 * @category    Counter
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class InvalidOptionException extends CounterException
{
    protected $message = 'Invalid counter option. ":name" counter has no ":option" option';
}
