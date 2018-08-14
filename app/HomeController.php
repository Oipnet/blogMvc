<?php
namespace App;

class HomeController extends \Core\Controller {
    public function index() {
        $model = new PostModel();
        $posts = $model->getAll();

        return $this->getView(compact('posts'));
    }
}