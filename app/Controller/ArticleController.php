<?php
namespace App\Controller;

use App\Model\Post;
use Core\Request;

class ArticleController extends \Core\Controller {
    public function show(Request $request, $slug)
    {
        $model = new Post($this->getContainer());
        $post = $model->findBy(['slug' => $slug]);

        return $this->getView('article/show.html', compact('post'));
    }
}