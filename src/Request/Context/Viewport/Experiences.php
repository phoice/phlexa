<?php

namespace Phlexa\Request\Context\Viewport;

class Experiences implements ExperiencesInterface
{
    /** @var array */
    private $experiences = [];

    /**
     * @return array
     */
    public function getExperiences(): array
    {
        return $this->experiences;
    }

    /**
     * @param array $experiences
     */
    public function setExperiences(array $experiences): void
    {
        $this->experiences = $experiences;
    }
}
