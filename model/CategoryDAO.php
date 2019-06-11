<?php

class CategoryDAO {
    public function showCategory($postID) {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $sql = "SELECT category.CategoryName, category.CategoryID, post.Title, post.PostID
                FROM ((category
                INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                RIGHT JOIN post on post.PostID = postcat.PostID)
                WHERE post.PostID = ?;";
        $query = $dbCon->prepare($sql);
        $query->bindParam(1, $postID);
        $query->execute();
        $getPostCat = $query->fetchAll();

        foreach ($getPostCat as $cat) {
            if($data['PostID'] = $cat['PostID']) {
                echo $cat['CategoryName'];
            }
        }
    }

    public function catShowAll($sort) {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort' DESC");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            // var_dump($query);

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

    public function catNature() {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)
                                            WHERE category.CategoryID = 1");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        if($_GET['sort'] == 'newest') {
            $sort = 'post.UploadedAt DESC';
        } elseif($_GET['sort'] == 'mostLikes') {
            $sort = 'likes.Likes DESC';
        } elseif($_GET['sort'] == 'leastLikes') {
            $sort = 'likes.Dislikes DESC';
        } else {
            $sort = 'post.UploadedAt DESC';
        }

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort'");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

    public function catBuildings() {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)
                                            WHERE category.CategoryID = 2");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        if($_GET['sort'] == 'newest') {
            $sort = 'post.UploadedAt DESC';
        } elseif($_GET['sort'] == 'mostLikes') {
            $sort = 'likes.Likes DESC';
        } elseif($_GET['sort'] == 'leastLikes') {
            $sort = 'likes.Dislikes DESC';
        } else {
            $sort = 'post.UploadedAt DESC';
        }

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort'");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

    public function catExplosions() {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)
                                            WHERE category.CategoryID = 3");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        if($_GET['sort'] == 'newest') {
            $sort = 'post.UploadedAt DESC';
        } elseif($_GET['sort'] == 'mostLikes') {
            $sort = 'likes.Likes DESC';
        } elseif($_GET['sort'] == 'leastLikes') {
            $sort = 'likes.Dislikes DESC';
        } else {
            $sort = 'post.UploadedAt DESC';
        }

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort'");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

    public function catIllustrations() {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)
                                            WHERE category.CategoryID = 4");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        if($_GET['sort'] == 'newest') {
            $sort = 'post.UploadedAt DESC';
        } elseif($_GET['sort'] == 'mostLikes') {
            $sort = 'likes.Likes DESC';
        } elseif($_GET['sort'] == 'leastLikes') {
            $sort = 'likes.Dislikes DESC';
        } else {
            $sort = 'post.UploadedAt DESC';
        }

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort'");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

    public function catMemes() {
        $user = 'surcrit_dk';
        $pass = 'succeeded';
        $dbCon = dbCon($user, $pass);

        $query = $dbCon->prepare("SELECT category.CategoryID, post.PostID
                                            FROM ((category
                                            INNER JOIN postcat on category.CategoryID = postcat.CategoryID) 
                                            RIGHT JOIN post on post.PostID = postcat.PostID)
                                            WHERE category.CategoryID = 5");

        $query->execute();
        $getPostsbyCat = $query->fetchAll();

        if($_GET['sort'] == 'newest') {
            $sort = 'post.UploadedAt DESC';
        } elseif($_GET['sort'] == 'mostLikes') {
            $sort = 'likes.Likes DESC';
        } elseif($_GET['sort'] == 'leastLikes') {
            $sort = 'likes.Dislikes DESC';
        } else {
            $sort = 'post.UploadedAt DESC';
        }

        foreach ($getPostsbyCat as $cat) {

            $query = $dbCon->prepare("SELECT post.PostID, post.Img, post.Title, post.Description, post.UploadedAt, post.isFlagged,`user`.`UserID`, `user`.Username, 
                                    likes.Likes, likes.Dislikes, TIMESTAMPDIFF(hour, `UploadedAt`, CURRENT_TIMESTAMP) AS TimeDiff
                                    FROM likes, post 
                                    LEFT JOIN `user`
                                    ON post.UserID = `user`.`UserID`
                                    WHERE post.PostID = likes.PostID
                                    ORDER BY '$sort'");

            $query->execute();
            $getAllPosts = $query->fetchAll();

            foreach($getAllPosts as $data) {
                if($cat['PostID'] == $data['PostID']) {
                    include('../includes/exploreShowPosts.php');
                }
            }

        }
    }

}