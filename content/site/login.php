<?php
// REG 1801459  
    require './include/connect.php';
    if ( !isset($_POST['username'], $_POST['password']) ) {
        //Just silenty redirect if something went wrong
        return header('Location: index.php');
    }

    //Use the prepare method to avoid SQL injection..
    $query = $_con->prepare('SELECT id, pass, salt, is_admin FROM users WHERE uname = ?');
    $query->bind_param('s', $_POST['username']);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($id, $pass, $salt, $is_admin); //Lazy way to mass-assign vars :)
        $query->fetch();
        $hashedPass = sha1($_POST['password'].$salt);
        if ($hashedPass === $pass) {
            session_regenerate_id();
            $_SESSION['uname'] = $_POST['username'];
            $_SESSION['id'] = $id;
            if ($is_admin === 1) {
                $_SESSION['is_admin'] = true;
            }
            return header('Location: index.php');
        } else {
            return header('Location: signin.php?error=Incorrect username or password specified');
        }
    } else {
        //To deter brute force attacks, be vague about which exact field was wrong
        return header('Location: signin.php?error=Incorrect username or password specified');
    }

    $query->close();
