<?php


namespace App\Controllers\Admin;


use App\App;
use App\Controllers\Base\AuthController;
use App\Views\BasePage;
use App\Views\Forms\Admin\AddForm;
use Core\View;

class EditController extends AuthController
{
    protected AddForm $form;
    protected BasePage $page;

    public function __construct()
    {
        parent::__construct();
        $this->form = new AddForm();
        $this->page = new BasePage([
            'title' => 'Edit pizza',
        ]);
    }

    public function edit(): ?string
    {
        $row_id = $_GET['id'] ?? null;

        if ($row_id === null) {
            header("Location: /list");
            exit();
        }

        $this->form->fill(App::$db->getRowById('pizzas', $row_id));

        if ($this->form->validate()) {
            $clean_inputs = $this->form->values();

            App::$db->updateRow('pizzas', $row_id, $clean_inputs);

            $p = 'You edited the pizza';
        }

        $content = new View([
            'title' => 'Edit pizza',
            'form' => $this->form->render(),
            'message' => $p ?? null
        ]);

        $this->page->setContent($content->render(ROOT . '/app/templates/content/forms.tpl.php'));

        return $this->page->render();
    }

}