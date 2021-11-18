<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<?php include("connect.php"); ?>

<html>
    <head>

    <title>RPA Fridays 14 - Web trigger</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta id="contentLanguage" http-equiv="Content-Language" content="cs-CZ">
    <meta name="viewport" content="width=600, maximum-scale=1.0, user-scalable=yes">
    
    </head>
    <body>
        Menu: <a href="?page=">Home</a> | <a href="?page=send_request">New request</a>

        <?php if ($_REQUEST["page"] == "send_request"){ ?>
            
            <h1>Send request</h1>
            <form action="?page=submit" method="POST">
                Text to convert: <textarea name="text" cols="50" rows="5"></textarea>
                Your email: <input type="text" name="mail">
                <input type="submit" value="Submit">
            </form>
        

        <?php }elseif ($_REQUEST["page"] == "submit"){ ?>
            
            <h1>Submit request</h1>
            <?php 
                $sql = "INSERT INTO requests (status, text, mail) VALUES ('waiting', '".$_REQUEST["text"]."', '".$_REQUEST["mail"]."');";
                $query = mysqli_query($conn,$sql); 
                if ($query){
                    echo "Request submitted. Go to Home to watch when it is done.";
                }else{
                    echo "Some problem: ".mysqli_error($conn);
                }
            ?>


        <?php }else{ ?>
            
            <h1>Home</h1>
            <?php 
                $query = "SELECT id, status, text, morse FROM requests ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                /* fetch associative array */
                while ($row = mysqli_fetch_array($result)) {
                    echo $row[0]." | ".$row["status"]." | ".$row["text"]." | ".$row["morse"]." |<br>";
                }
            ?>

        <?php } ?>

    </body>
</html>