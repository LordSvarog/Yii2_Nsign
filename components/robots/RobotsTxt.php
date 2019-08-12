<?php

namespace app\components\robots;

use app\components\robots\adapters\AdapterRobotsInterface;
use yii;
/**
 * Class RobotsTxt
 *
 * @package app\components\robots
 */
class RobotsTxt implements RobotsTxtInterface
{
    /**
     * @var AdapterRobotsInterface
     */
    public $robots;
    /**
     * @var array directives for generator
     */
    public $dirs = [];
    /**
     * @return string
     */
    private function getPath() :string
    {
        return Yii::$app->getBasePath() . '/robots.txt';
    }
    /**
     * @return string
     */
    public function render(): string
    {
        $robots = file_get_contents($this->getPath());

        return $robots;
    }
    /**
     * @return boolean
     *
     * @throws yii\base\InvalidConfigException
     * @throws yii\di\NotInstantiableException
     */
    public function save(): bool
    {
        $robots = Yii::$container->get($this->robots);

        if ($robots->render($this->getPath(), $this->dirs))
            return true;
        return false;
    }
    /**
     * @param $item string
     * @param $name string
     *
     * @return string
     */
    private function search($item, $name) :string
    {
        return (strpos($item, $name) !== false) ? str_replace($name . ": ", "", $item) : '';
    }
    /**
     * Check robots.txt file
     *
     * @return array
     */
    public function check(): array
    {
        if (is_file($this->getPath())) {
            $robots = file_get_contents($this->getPath());
            $robots = explode(PHP_EOL, $robots);

            foreach ($robots as $item) {
                foreach ($this->dirs as $key => $value) {
                    $res = $this->search($item, $key);
                    $dir = &$this->dirs[$key];
                    if ($dir !== '' && $res !== '')
                        $dir .= PHP_EOL . $res;
                    else
                        $dir .= $res;
                }
            }
        }

        return $this->dirs;
    }
}