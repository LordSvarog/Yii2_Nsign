<?php

namespace app\components;

use yii\i18n\Formatter;

class FormatterPhoneNumber extends Formatter
{
    /**
     * string $phoneMask - Маска, которая будет применена к номеру
     */
    public $phoneMask = '8 ($1) $2 $3-$4';
    /**
    * Форматирует номер телефона в соответствии с выбранной маской
    *
    * @param string $value - Номер телефона, который необходимо вывести
    *
    * @return string - отформатированный номер
    */
    public function asPhone($value)
    {
    return preg_replace("/^8(\d{3})(\d{3})(\d{2})(\d{2})$/", $this->phoneMask, $value);
    }
}