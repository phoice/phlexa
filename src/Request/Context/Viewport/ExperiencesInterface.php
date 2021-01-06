<?php
namespace Phlexa\Request\Context\Viewport;

interface ExperiencesInterface
{
    /**
     * @return array
     */
    public function getExperiences(): array;

    /**
     * @param array $experiences
     */
    public function setExperiences(array $experiences): void;
}
