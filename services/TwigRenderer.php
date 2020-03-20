<?php

namespace App\services;

class TwigRenderer
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->twig = new \Twig\Environment($loader);
    }

    public function render(string $template, array $params = [])
    {        
        return $this->twig->render($template . '.html.twig', $params);
    }
}
