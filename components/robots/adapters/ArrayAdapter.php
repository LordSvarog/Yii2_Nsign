<?php

namespace app\components\robots\adapters;

use app\components\robots\generators\GeneratorRobotsTxtInterface;
use yii;

/**
 * Class ArrayAdapter
 *
 * @package app\components\robots\adapters
 */
class ArrayAdapter implements AdapterRobotsInterface
{
    /**
     * @var GeneratorRobotsTxtInterface
     */
    protected $generator;
    /**
     * ArrayAdapter constructor.
     * @param GeneratorRobotsTxtInterface $generator
     */
    public function __construct(GeneratorRobotsTxtInterface $generator)
    {
        $this->generator = $generator;
    }
    /**
     * @param $path
     * @param string $data
     *
     * @return boolean
     */
    protected function save($path, $data):bool
    {
        return file_put_contents($path, $data) ? true : false;
    }

    /**
     * @param string $path
     * @param array $dirs
     *
     * @return boolean
     */
    public function render($path, array $dirs): bool
    {
        foreach ($dirs as $key => $val) {
            $this->generator->params[$key] = Yii::$app->request->post($key);
        }

        $data = $this->generator->create();

        if ($this->save($path, $data))
            return true;
        return false;
    }
}