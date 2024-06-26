<?php
/**
 * This file is VideoMeta class
 *
 * PHP version 7
 *
 * @category    Media
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Media\Models\Meta;

/**
 * Class VideoMeta
 *
 * @category    Media
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class VideoMeta extends Meta
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files_video';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'file_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'audio' => 'array',
        'video' => 'array',
    ];

    /**
     * The foreign key name for the model.
     *
     * @var string
     */
    protected $foreignKey = 'file_id';

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (! isset($model->site_key)) {
                $model->site_key = \XeSite::getCurrentSiteKey();
            }
        });

        self::updating(function ($model) {
            if (! isset($model->site_key)) {
                $model->site_key = \XeSite::getCurrentSiteKey();
            }
        });

        self::saving(function ($model) {
            if (! isset($model->site_key)) {
                $model->site_key = \XeSite::getCurrentSiteKey();
            }
        });

    }
}
