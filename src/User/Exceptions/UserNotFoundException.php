<?php
/**
 *  This file is part of the Xpressengine package.
 *
 * PHP version 7
 *
 * @category    User
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\User\Exceptions;

use Xpressengine\User\UserException;

/**
 * @category    User
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class UserNotFoundException extends UserException
{
    protected $message = 'User not found.';
}
