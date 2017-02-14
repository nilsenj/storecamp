<?php

namespace storecamp\htmlelements\Bridges\Config;

use Illuminate\Contracts\Config\Repository;

class Laravel5Config implements ConfigInterface
{

    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getIconPrefix()
    {
        return $this->repository->get('htmlelements.icon_prefix');
    }

    public function getIconTag()
    {
        return $this->repository->get('htmlelements.icon_tag');
    }

    public function gethtmlelementsVersion()
    {
        return $this->repository->get('htmlelements.bootstrapVersion');
    }

    public function getJQueryVersion()
    {
        return $this->repository->get('htmlelements.jqueryVersion');
    }
}
