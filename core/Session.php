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

        $this->attributes = array_map(function ($elt) { return htmlentities($elt);}, $_SESSION);
    }

    public function get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function set($name, $value) {
        $this->attributes[$name] = htmlentities($value);
        $_SESSION[$name] = $value;

        return $this;
    }

    public function remove($name) {
        unset($this->attributes[$name]);
        unset($_SESSION[$name]);

        return $this;
    }
}