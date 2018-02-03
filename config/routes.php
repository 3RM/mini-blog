<?php

return array(
    'blog/([0-9]+)' => 'blog/post/$1',
    'blog' => 'blog/posts',
    //Главная
    '' => 'blog/posts' //actionIndex в SiteController
    
);
