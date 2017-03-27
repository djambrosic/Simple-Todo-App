<?php

class View
{
    /**
     * @var string
     */
    private $header;
    /**
     * @var string
     */
    private $footer;

    /**
     * Render view template
     * @param string $view
     * @param array $data
     */
    public function render($view, $data = [])
    {
        if(isset($this->header)) require_once 'views/'. $this->header .'.php';
        require_once 'views/'. $view .'.php';
        if(isset($this->footer)) require_once 'views/'. $this->footer .'.php';
    }

    /**
     * Set new header template
     * @param string $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * Set new footer template
     * @param string $footer
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
    }
}