<?php
declare(strict_types=1);
namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = "")
    {
        parent::__construct($title);
    }
    /**Produire la page web complète
     * @return string
     */
    public function toHTML(): string
    {
        $html= '<!doctype html><html lang="fr"><head>';
        $html= $html.$this->getHead().'<meta charset="utf-8"><meta name="viewport"><title>';
        $html = $html.$this->getTitle().'</title></head><body><header class="header"><h1>'.$this->getTitle();
        $html = $html.'</h1></header><div class="content">'.$this->getBody().'</div><div class="footer"> ';
        $html = $html.$this->getLastModification().'</div></body></html>';
        return $html;
    }
}