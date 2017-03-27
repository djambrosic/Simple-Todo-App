<?php


class App
{
    /**
     * @var string
     */
    protected $controller = 'HomeController';
    /**
     * @var string
     */
    protected $method = 'index';
    /**
     * @var array
     */
    protected $params = [];

    public function __construct()
    {
        Session::start();
        $url = $this->parseUrl();

        if(file_exists('controllers/'. ucfirst($url[0]) .'Controller.php'))
        {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once 'controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {

                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Return parsed URL
     * @return array
     */
    private function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}