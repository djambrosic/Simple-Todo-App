<?php

class Controller
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var array
     */
    private $js = [];

    /**
     * Set default header an footer, instantiate View class
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
        $this->view->setHeader('includes/header');
        $this->view->setFooter('includes/footer');
    }

    /**
     * Instantiate model
     * @param string $model
     * @return bool
     */
    protected function model($model)
    {
        if(file_exists('models/'. ucfirst($model) .'.php'))
        {
            $model = ucfirst($model);
            require_once 'models/'. $model .'.php';
            return new $model();
        }
        return false;
    }

    /**
     * Sets Javascript files to be loaded upon page loaded
     * @param string $js
     */
    public function setJS($js)
    {
        $this->js[] = $js;
    }

    /**
     * Returns all Javascript files
     * @return array
     */
    public function getJS()
    {
        return $this->js;
    }
}