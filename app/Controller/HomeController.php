<?php
namespace App\Controller;

use App\Model\Post;
use Core\Request;

class HomeController extends \Core\Controller {

    /**
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(Request $request)
    {
        $model = new Post($this->getContainer());
        $posts = $model->all(['limit' => 3]);

        return $this->getView('homepage.html', compact('posts'));
    }
}