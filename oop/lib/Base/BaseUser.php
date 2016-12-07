<?php

namespace Academy\Base;

class BaseUser
{

    /**
     * Strorage provider instance.
     *
     * @var object
     */
    protected $provider;

    /**
     * Sets user storage provider instance.
     *
     * @param object $provider Provider instance.
     *
     * @return $this
     */
    public function setProvider($provider)
    {
        if (!$provider->active) {
            throw new \BadMethodCallException('Provider must be active');
        }
        
        $this->provider = $provider;
        return $this;
    }

    public function search(array $criteria)
    {
        $criteria = static::prepareCriteria($criteria);
        return $this->provider->findAll($criteria);
    }
}
