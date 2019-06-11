<?php
require_once (__DIR__ . '/../model/CategoryDAO.php');

if(isset($_GET['cat'])) {
    $cat = $_GET['cat'];

    if($cat == 'showall') {

        if($sortOpt == 'newest') {
            $sort = 'post.UploadedAt';
        } elseif($sortOpt == 'mostLikes') {
            $sort = 'likes.Likes';
        } elseif($sortOpt == 'leastLikes') {
            $sort = 'likes.Dislikes';
        } else {
            $sort = 'post.UploadedAt';
        }

        $catFunc = new CategoryDAO();
        $catFunc->catShowAll($sort);

    } elseif($cat == 'nature') {
        $catFunc = new CategoryDAO();
        $catFunc->catNature();

    } elseif($cat == 'buildings') {
        $catFunc = new CategoryDAO();
        $catFunc->catBuildings();


    } elseif($cat == 'explosions') {
        $catFunc = new CategoryDAO();
        $catFunc->catExplosions();


    } elseif($cat == 'illustrations') {
        $catFunc = new CategoryDAO();
        $catFunc->catIllustrations();


    } elseif($cat == 'memes') {
        $catFunc = new CategoryDAO();
        $catFunc->catMemes();


    } else {
        $catFunc = new CategoryDAO();
        $catFunc->catShowAll();


    }
}