<?php

namespace app\components\redirect;

interface RedirectInterface
{
    /**
     * @return array|false
     */
    public function findRule();
}