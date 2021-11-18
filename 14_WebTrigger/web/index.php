<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<?php include("connect.php"); ?>

<html>
    <head>

    <title>RPA Fridays 14 - Web trigger</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta id="contentLanguage" http-equiv="Content-Language" content="cs-CZ">
    <meta name="viewport" content="width=600, maximum-scale=1.0, user-scalable=yes">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

    </head>
    <body>
        <section class="section">
            <div class="container">
                Menu: <a href="?page=">Home</a> | <a href="?page=send_request">New request</a>

                <?php if ($_REQUEST["page"] == "send_request"){ ?>
                    <h1 class="title">Send request</h1>
                    <form action="?page=submit" method="POST">
                        <div class="field">
                            <label class="label">Text to convert</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="Textarea" name="text"></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="Email" name="mail">
                            </div>
                        </div>
                        <input type="submit" value="Submit">
                    </form>
                

                <?php }elseif ($_REQUEST["page"] == "submit"){ ?>
                    <h1 class="title">Submit request</h1>
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
                    <h1 class="title">Home</h1>
                        <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Text</th>
                                <th>Morse</th>
                            </tr>
                        </thead>
                        <?php 
                            $query = "SELECT id, status, text, morse FROM requests ORDER BY id DESC";
                            $result = mysqli_query($conn, $query);
                            /* fetch associative array */
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>
                                    <th>".$row[0]."</th>
                                    <td>".$row["status"]."</td>
                                    <td>".$row["text"]."</td>
                                    <td>".$row["morse"]."</td>
                                </tr>";
                            }
                        ?>
                        </table>
                <?php } ?>
                <a href="https://www.youtube.com/watch?v=CQ-KUzSKe0E" target="_new">ABOUT THIS RPA FRIDAYS</a>
            </div>
        </section>                
    </body>
</html>