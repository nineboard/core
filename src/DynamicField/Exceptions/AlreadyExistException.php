<?php
/**
 * AlreadyExistException
 *
 * PHP version 7
 *
 * @category    DynamicField
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\DynamicField\Exceptions;

use Xpressengine\DynamicField\DynamicFieldException;

/**
 * AlreadyExistException
 *
 * @category    DynamicField
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class AlreadyExistException extends DynamicFieldException
{
    protected $message = 'An ID already exists for that type.';
}
