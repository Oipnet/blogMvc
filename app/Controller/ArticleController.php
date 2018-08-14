<?php
namespace App\Controller;

use App\Model\Post;

class ArticleController extends \Core\Controller {
    public function show($slug)
    {
        $model = new Post();
        $post = $model->findBy(['slug' => $slug]);

        return $this->getView('article/show.html', compact('post'));
    }
}