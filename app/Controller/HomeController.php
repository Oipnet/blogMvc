<?php
namespace App\Controller;

use App\Middleware\AuthMiddleware;
use App\Model\Post;
use Core\Container;
use Core\Controller;
use Core\Request;

class HomeController extends Controller {

    public function __construct() {
        $this->middlewares[] = AuthMiddleware::class;

        parent::__construct();
    }
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