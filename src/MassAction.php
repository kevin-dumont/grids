<?php

namespace Sygmaa\Grids;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MassAction
 * @package Sygmaa\Grids
 */
class MassAction extends Action
{
    /**
     * @var
     */
    private $url;

    /**
     * @param Request $request
     * @param $label
     * @param $url
     */
    public function __construct(Request $request, $label, $url)
    {
        parent::__construct($request, $label);
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

}