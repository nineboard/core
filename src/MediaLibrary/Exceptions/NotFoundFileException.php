<?php
/**
 * NotFoundFileException.php
 *
 * PHP version 7
 *
 * @category    MediaLibrary
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\MediaLibrary\Exceptions;

use Xpressengine\Support\Exceptions\HttpXpressengineException;

/**
 * Class NotFoundFileException
 *
 * @category    MediaLibrary
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class NotFoundFileException extends HttpXpressengineException
{
    protected $message = 'xe::fileNotFoundMessage';
}
