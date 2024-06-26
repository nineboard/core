<?php
/**
 * Instance Route
 *
 * PHP version 7
 *
 * @category  Routing
 *
 * @author    XE Developers <developers@xpressengine.com>
 * @copyright 2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link      https://xpressengine.io
 */

namespace Xpressengine\Routing;

use Xpressengine\Database\Eloquent\DynamicModel;
use Xpressengine\Menu\Models\MenuItem;
use Xpressengine\Site\Site;

/**
 * Instance Route
 *
 * @category Routing
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license   http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 *
 * @property string $url url
 * @property string $module module id
 * @property string $instance_id instance Id
 * @property string $menu_id menu id
 * @property string $site_key site key
 */
class InstanceRoute extends DynamicModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instance_route';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Aggregator relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function MenuItem()
    {
        return $this->belongsTo(MenuItem::class, 'instance_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_key', 'site_key');
    }
}
