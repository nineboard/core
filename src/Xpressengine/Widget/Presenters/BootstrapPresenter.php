<?php
/**
 * BootstrapPresenter.php
 *
 * PHP version 7
 *
 * @category    Widget
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Widget\Presenters;

use Illuminate\Support\Arr;
use Xpressengine\UIObject\Element;

/**
 * Class BootstrapPresenter
 *
 * @category    Widget
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2020 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class BootstrapPresenter extends AbstractPresenter
{
    /**
     * The name of presenter
     *
     * @var string
     */
    const NAME = 'Bootstrap';

    /**
     * The number of columns supported by the presenter
     *
     * @var int
     */
    const COLS = 12;

    /**
     * Get HTML wrapper for row contents
     *
     * @param  string  $content  row contents
     */
    protected function getRowWrapper(string $content, array $options): string
    {
        $row = new Element('div');

        if ($attributes = Arr::get($options, 'attributes')) {
            $this->setElementAttributes($row, $attributes);
        }

        return $row->addClass($this->getRowClass())->append($content)->render();
    }

    /**
     * get row's class
     */
    protected function getRowClass(): string
    {
        return 'row';
    }

    /**
     * Get HTML wrapper for column contents
     *
     * @param  string  $content  column content
     * @param  array  $grid  column grid data
     * @param  array  $options  column options
     */
    protected function getColumnWrapper(string $content, array $grid = [], array $options = []): string
    {
        $classes = [];

        foreach ($grid as $type => $count) {
            $classes[] = $this->getColumnClass($type, $count);
        }

        $col = new Element('div');

        if ($attributes = Arr::get($options, 'attributes')) {
            $this->setElementAttributes($col, $attributes);
        }

        return $col->addClass(implode(' ', $classes))->append($content)->render();
    }

    /**
     * Get the css class for given type and count
     *
     * @param  string  $type  device type
     * @param  int  $count  span count
     */
    protected function getColumnClass(string $type, int $count): string
    {
        return sprintf('col-%s-%s', $type, $count);
    }
}
