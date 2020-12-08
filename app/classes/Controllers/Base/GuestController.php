<?php
namespace App\Controllers\Base;

use App\App;

class GuestController
{
    protected $redirect = '/index.php';

    public function __construct()
    {

        if (App::$session->getUser()) {
            header("Location: $this->redirect");
            exit();
        }
    }
}