<?php


namespace App\Controllers;

use App\App;
use App\Controllers\Base\GuestController;
use App\Views\Forms\LoginForm;
use App\Views\BasePage;
use Core\View;


class LoginController extends GuestController
{


    protected $form;
    protected $page;


    public function __construct()
    {
        parent:: __construct();
        $this->form = new LoginForm();
        $this->page = new BasePage([
            'title' => 'Prisijunk',
        ]);

    }

    public function index()
   {

       if ($this->form->validate()) {
           $clean_inputs = $this->form->values();

           App::$session->login($clean_inputs['email'], $clean_inputs['password']);

           if (App::$session->getUser()) {
               header("Location: Admin/add.php");
               exit();
           }
       }

       $this->page->setContent($this->form->render());

       return $this->page->render();
   }
}