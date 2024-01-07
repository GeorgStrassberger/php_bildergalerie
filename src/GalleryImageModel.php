<?php

class GalleryImageModel
{
    public  $src;
    public $title;

    public function __construct(string $src, string $title){
        $this->title = $title;
        $this->src = $src;
    }

}