<?php

namespace app\components\robots\generators;

use yii;
use yii\di\Instance;

class GeneratorRobotsTxt implements GeneratorRobotsTxtInterface
{
    /**
     * @var GeneratorDirectiveInterface[]
     */
    public $directive_generators = [];
    /**
     * @var array robots.txt other directives
     */
    public $params = [];
    /**
     * @var array robots.txt basic directives
     */
    public $directives = [];

    /**
     * create robots.txt
     *
     * @return string
     * @throws yii\base\InvalidConfigException
     */
    public function create(): string
    {
        $robots_txt = implode(PHP_EOL, $this->directives);
        $robots_txt .= PHP_EOL;

        foreach ($this->directive_generators as $directive => $generator){
            $generator = Instance::ensure($generator, GeneratorDirectiveInterface::class);
            $robots_txt .= $generator->generate($this->params[$directive]);
        }

        return $robots_txt;
    }
}
