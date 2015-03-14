<?php

namespace Gos\Bundle\PubSubRouterBundle\Router;

/**
 * @author Johann Saunier <johann_27@hotmail.fr>
 */
class RouteCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var Route[]
     */
    protected $routes;

    public function __clone()
    {
        /**
         * @var string $name
         * @var Route $route
         */
        foreach($this->routes as $name => $route){
            $this->routes[$name] = clone $route;
        }
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->routes);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->routes);
    }

    /**
     * @param string      $name
     * @param Route $route
     */
    public function add($name, Route $route)
    {
        unset($this->routes[$name]);
        $this->routes[$name] = $route;
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        foreach((array) $name as $n){
            unset($this->routes[$n]);
        }
    }

    /**
     * @param string $name
     *
     * @return Route|null
     */
    public function get($name)
    {
        return isset($this->routes[$name]) ? $this->routes[$name] : null;
    }

    /**
     * @return Route[]
     */
    public function all()
    {
        return $this->routes;
    }

    /**
     * @param RouteCollection $collection
     */
    public function addCollection(RouteCollection $collection)
    {
        foreach ($collection->all() as $name => $route) {
            $this->add($name, $route);
        }
    }
}