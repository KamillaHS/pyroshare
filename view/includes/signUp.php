<?php
require( __DIR__ . "/../../database/dbcon.php" );

function createUser($email, $username, $country, $birthday, $password)
{
    try
    {
        global $cxn;

//        $handle = $cxn->prepare('INSERT INTO `user` (Email, Username, Country, Birthday, Password)
//                                        VALUES (?, ?, ?, ?, ?)');
//        $handle->bind_param("sssss", $email,$username,$country,$birthday,$password);

        $handle = $cxn->prepare('INSERT INTO `user` (Email, Username, Country, Birthday, Password) 
                                        VALUES (?, ?, ?, ?, ?)');
        $handle->bindParam(1, $email);
        $handle->bindParam(2, $username);
        $handle->bindParam(3, $country);
        $handle->bindParam(4, $birthday);
        $handle->bindParam(5, $password);

        $handle->execute();
        $cxn = null;



        header("Location: ./../view/includes/loggedin.php");
        die();
    }
    catch(\PDOException $ex){
        print($ex->getMessage());
    }
}

 ?>



<html lang="en">

<body>

<div id="signUpForm">
    <form method="post" action="../../model/handleUser.php?action=create">
        <input type="text" name="email" placeholder="Email" required>
        <br><br>
        </input>
        <input type="text" name="username" placeholder="Username" required>
        <br><br>
        </input>
        <input type="text" name="country" placeholder="Country" required>
        <br><br>
        </input>
        <p>Birthday</p>
        <input type="date" name="birthday" required>
        <br><br>
        </input>
        <input type="password" name="password" placeholder="Password" required>
        <br><br>
        </input>
        <input type="submit" name="signUp" value="Sign Up">
    </form>
</div>



</body>
</html>

