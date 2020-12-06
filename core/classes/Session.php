<?php

namespace Core;

use App\App;

class Session
{
    private ? array $user = null;

    /**
     * Session constructor
     */
    public function __construct()
    {
        session_start();

        $this->loginFromCookie();
    }

    /**
     * Check there is Seesion already or not
     */
    public function loginFromCookie()
    {
        if ($_SESSION) {
            $this->login($_SESSION['email'], $_SESSION['password']);
        }

    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function login($email, $password): bool
    {
        $user = App::$db->getRowWhere('users', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($user) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $this->user = $user;

            return true;
        }

        $this->user = null;
        return false;
    }

    /**
     * @return array
     */
    public function getUser(): ?array
    {

        return $this->user;
    }

    /**
     * destroy Seesion and redirecting if param given.
     *
     * @param null $redirect
     */
    public function logout($redirect = null)
    {
        $_SESSION = [];
        session_destroy();

        if ($redirect) {
            header("Location: $redirect");
        }
    }
}