<?php

namespace app\components\robots\adapters;

use app\components\robots\GeneratorRobotsTxtInterface;

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
     * @param array $data
     * @return string
     */
    public function render($data): string
    {
        $this->generator->host = $data['host'];
        $this->generator->sitemap = $data['sitemap'];
        $this->generator->userAgent = $data['userAgent'];

        $this->generator->init();

        $result = $this->generator->render();

        return $result;
    }
}