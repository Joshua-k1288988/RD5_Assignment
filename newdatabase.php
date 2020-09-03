<?php
    require("linksql.php");
    $sql = "CREATE TABLE userdata(
        user varchar(20),
        ID varchar(20) PRIMARY KEY,
        password varchar(100),
        money int 
    );";
    mysqli_query($link , $sql);

    $sql = "CREATE TABLE userList(
        listID int AUTO_INCREMENT PRIMARY KEY,
        ID varchar(20),
        date varchar(30),
        actionList varchar(100),
        FOREIGN KEY (ID) REFERENCES userdata(ID) 
    );";
    mysqli_query($link , $sql);

    mysqli_close($link);
?>