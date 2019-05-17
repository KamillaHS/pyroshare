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
                WHERE post.PostID = '$postID';";
        $query = $dbCon->prepare($sql);
        $query->execute();
        $getPostCat = $query->fetchAll();

        foreach ($getPostCat as $cat) {
            if($data['PostID'] = $cat['PostID']) {
                echo $cat['CategoryName'];
            }
        }
    }
}