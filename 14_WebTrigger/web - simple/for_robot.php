<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<?php include("connect.php"); ?>

<html>
    <head>

    <title>For robot</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta id="contentLanguage" http-equiv="Content-Language" content="cs-CZ">
    <meta name="viewport" content="width=600, maximum-scale=1.0, user-scalable=yes">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    </head>
    <body>

        <h1>For robot</h1>

        <?php if ($_REQUEST["page"] == "solve"){ 
            // to parameters input text

            $sql = "UPDATE requests SET status = 'done', morse = '".$_REQUEST["morse"]."' WHERE id='".$_REQUEST["id"]."'";

            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }

        ?>
        <?php } ?>

        <?php 
            $query = "SELECT id, status, text FROM requests WHERE status = 'waiting' ORDER BY id ASC";
            $result = mysqli_query($conn, $query);
            /* fetch associative array */
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class=\"request\">".$row[0]."|".$row["text"]."</div>";
            }
        ?>


    </body>
</html>