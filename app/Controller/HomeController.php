<?php
namespace App\Controller;

class HomeController extends \Core\Controller {
    public function index()
    {
        $posts = [
            [ 'title' => 'Article 1', 'summary' => 'Mon super article 1'],
            [ 'title' => 'Article 2', 'summary' => 'Mon super article 2'],
        ];

        return $this->getView('homepage.html', compact('posts'));
    }
}