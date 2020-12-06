<?php

namespace Core;


class Cookie
{
    public $name;
    public $value;
    public $time;

    public function __construct($name)
    {
        $this->cookieName($name);
    }

    /**
     * set cookie name;
     *
     * @param $name_given
     */
    public function cookieName($name_given)
    {
        $this->name = $name_given;
    }

    /**
     * set cookie value
     *
     * @param $value_given
     */
    public function cookieValue($value_given)
    {
        $this->value = $value_given;

    }

    /**
     * set cookie time
     *
     * @param $time_given
     */
    public function cookieTime($time_given)
    {
        $this->time = $time_given;
    }

    /**
     *
     * setcookie for user for example
     *
     */
    public function set()
    {
        setcookie($this->name, $this->value, $this->time);

    }

    /**
     * get created cookie
     *
     * @return array|mixed
     */
    public function getCookie()
    {
        $cookie = $_COOKIE[$this->name] ?? [];

        return $cookie;
    }

    /**
     *
     * delete cookie
     *
     */
    public function unset()
    {
        setcookie($this->name, null,  - 1);

    }

}