<?php 
    error_reporting(E_ERROR | E_PARSE);
    include "params.php";                                                //php file with current settings
    $conn = mysqli_connect($sqlconn, $user, $password, $database);       //database connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "select * from whologged";
    $result = mysqli_query($conn, $sql);
    $ct = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if($ct)                                                              //user is already logged - redirect
    {
        $new_url = $url . 'index.php';
        header('Location: '.$new_url);
        die();
    }
    if($_POST['login'])
    {
        $conn = mysqli_connect($sqlconn, $user, $password, $database);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "select * from users where login = '".$_POST['login']."'";
        $result = mysqli_query($conn, $sql);
        $ct = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if(!$ct)                                                          //login doesn't exist = error
        {
            $new_url = $url . 'login.php?nologin=' . $_POST['login'];
            header('Location: '.$new_url);
            die();
        }
        else {
            foreach ($ct as $chars) {
                if($chars['password'] != $_POST['password'])               //wrong password = error      
                {
                    $new_url = $url . 'login.php?password=failed';
                }  
                else 
                {
                    $conn = mysqli_connect($sqlconn, $user, $password, $database);
                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    } 
                    $sql = "insert into whologged (login, adminrights) values ('".$_POST['login']."',".$chars['adminrights'].")";
                    $result = mysqli_query($conn, $sql);
                    if($chars['adminrights'] == 1)                           //admin rights = redirect to index.php
                      $new_url = $url . 'index.php';
                    else 
                    {
                        $sql = "delete from whologged";                      //no admin rights = redirect to noadmin.php
                        $result = mysqli_query($conn, $sql);
                        $new_url = $url . 'noadmin.php';
                    }
                }
                header('Location: '.$new_url);
                die();
            }
        }
    }
    //warnings
    if($_GET['nologin'])                                                           
    {
        echo("<h3 class='warn'>User '".$_GET['nologin']."' doesn't exist. </h3>");
    }
    if($_GET['password'])                                                           
    {
        echo("<h3 class='warn'>Wrong password!</h3>");
    }
    if($_GET['auth'])                                                           
    {
        echo("<h3 class='warn'>You need to authorize first!</h3>");
    }
    $conn = mysqli_connect($sqlconn, $user, $password, $database);