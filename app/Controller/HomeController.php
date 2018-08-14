<?php
namespace App\Controller;

use App\Model\Post;

class HomeController extends \Core\Controller {
    public function index()
    {
        $model = new Post();
        $posts = $model->all(['limit' => 3]);

        return $this->getView('homepage.html', compact('posts'));
    }
}