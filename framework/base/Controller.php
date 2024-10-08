<?php

namespace dee\base;

use Dee;

/**
 * Description of Controller
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Controller
{
    public $layout = '';
    public $defaultAction = 'index';
    public $id;
    public $route;
    public $action;
    /**
     *
     * @var Application
     */
    public $parent;

    public function __construct($id, $parent = null)
    {
        $this->id = $id;
        $this->parent = $parent;
    }

    public function render($view, $params = [])
    {
        $dview = Dee::$app->view;
        if (strncmp($view, '@', 1) !== 0 && strncmp($view, '/', 1) !== 0) {
            //$view = "/{$this->id}/$view";
            $view = "/$view";
        }
        $content = $dview->render($view, $params);
        if ($this->layout) {
            return $dview->render($this->layout, ['content' => $content]);
        } else {
            return $content;
        }
    }
  
     public function renderPartial($view, $params = [])
    {
        $dview = Dee::$app->view;
        if (strncmp($view, '@', 1) !== 0 && strncmp($view, '/', 1) !== 0) {
            $view = "/$view";
        }
        return $dview->render($view, $params);
    }

    /**
     *
     * @param string $route
     * @param array $params
     * @param bool $assoc
     * @return string|mixed
     * @throws \Exception
     */
    public function run($route = '', $params = [], $assoc = true)
    {
        if ($route == '') {
            $route = $this->defaultAction;
        }
        $this->action = $route;
        $this->route = $this->id . '/' . $route;
        $action = 'action' . str_replace(' ', '', ucwords(str_replace('-', ' ', $route)));

        $reflection = new \ReflectionMethod($this, $action);
        $args = [];
        foreach ($reflection->getParameters() as $param) {
            $name = $param->getName();
            if ($assoc && array_key_exists($name, $params)) {
                $args[] = $params[$name];
            } elseif (!$assoc && count($params)) {
                $args[] = array_shift($params);
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } else {
                throw new \Exception("Missing parameter '{$name}'");
            }
        }
        if (!$assoc && count($params)) {
            $args = array_merge($args, $params);
        }
        
        $filters = [];
        if ($this->parent !== null) {
            foreach ($this->parent->filters as $i => $filter) {
                if (!is_object($filter)) {
                    $this->parent->filters[$i] = $filter = Dee::createObject($filter);
                }
                $filters[$i] = $filter;
                if (!$filter->before()) {
                    return;
                }
            }
        }
        foreach ($this->filters() as $i => $filter) {
            if (!is_object($filter)) {
                $filter = Dee::createObject($filter);
            }
            $filters[$i] = $filter;
            if (!$filter->before()) {
                return;
            }
        }
        $output = call_user_func_array([$this, $action], $args);
        foreach (array_reverse($filters) as $filter) {
            $output = $filter->after($output);
        }
        return $output;
    }

    /**
     *
     * @return array|Filter[]
     */
    public function filters()
    {
        return[
        ];
    }

    public function aliases()
    {
        return[];
    }
}
