<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 15/08/18
 * Time: 14:05
 */

namespace Core;


class Session
{
    private $attributes = [];

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();

        $this->attributes = array_map(function ($elt) { return (is_string($elt))?htmlentities($elt):$elt;}, $_SESSION);
    }

    public function get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function set($name, $value): self
    {
        $this->attributes[$name] = (is_string($value))?htmlentities($value):$value;
        $_SESSION[$name] = $value;

        return $this;
    }

    public function remove($name): self
    {
        unset($this->attributes[$name]);
        unset($_SESSION[$name]);

        return $this;
    }

    public function getAuth()
    {
        return $this->get('auth');
    }
}