<?php

namespace Xpressengine\Spotlight\Importers;

abstract class AbstractImporter
{
    /**
     * @return mixed
     */
    abstract public function convert($value);

    /**
     * @return bool
     */
    abstract public function checkTarget($value);
}
