<?php include('session_manager.php');
$user_id = $_SESSION['id'];
?>
<?php
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "atreyashield";

// Create database connection
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
$sql2 = "SELECT * from files WHERE `owner_id`='$user_id'";
$result = mysqli_query($db, $sql2);

if (mysqli_query($db, $sql2)) {
    //echo $result;
} else {
    echo "Sorry Please reload and try again!";
}

if (isset($_POST["submit"])) {
    #$title = $_POST["title"]
    $pname = rand(1000, 1000) . "-" . $_FILES["file"]["name"];
    $t_name = $_FILES["file"]["tmp_name"];
    $uploads_dir = 'serverupload/';
    move_uploaded_file($t_name, $uploads_dir . '/' . $pname);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Bootstrap\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Julee">
    <link id="onyx-css" href="sidebar_css.css" rel="stylesheet">
    <title>Dashboard-AtreyaShield</title>
    <style>
        .font_family {
            font-weight: 900;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        .loginPopup {
            position: relative;
            text-align: center;
            width: 100%;
        }

        .formPopup {
            display: none;
            position: fixed;
            left: 55%;
            top: 5%;
            transform: translate(-50%, 5%);
            border: 3px solid #1f0838;
            border-radius: 10px;
            z-index: 9;
        }

        .formContainer {
            max-width: 300px;
            padding: 20px;
            background-color: #252525;
        }

        .formContainer input[type=text],
        .formContainer input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
        }

        .formContainer input[type=text]:focus,
        .formContainer input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        .formContainer {
            padding: 12px 20px;
            border: none;
            background-image: linear-gradient(to bottom right,#301934, #370f63);
            color: #fff;
            cursor: pointer;
            width: 100%;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            background-color: #3ca832;
            color: #FFFFFF;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;

        }

        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white col-lg-2" style="background-color: #1f0838">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img src="Logo\AtreyaShield-1.png" height="60px" width="60px">
                <span class="fs-4 font_family">AtreyaShield</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link font_family" aria-current="page" style="font-size: 18px; background-color: #FAFAFA; color: black; width: 110%; padding-left: 0px; padding-bottom: 10px;">
                        <svg class="bi me-2" width="16" height="16">

                        </svg>
                        &nbsp;&nbsp;<img src="PageIcons\homeBlack.png">&emsp;My Files
                    </a>
                </li>
                <li>
                    <a href="uploadFiles.php" class="nav-link text-white font_family" style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">

                        </svg>
                        <img src="PageIcons\uploadFilesWhite.png">&emsp;Upload Files
                    </a>
                </li>
                <li>
                    <a href="receivedFiles.php" class="nav-link text-white font_family" style="font-size: 15px; width: 110%; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16"></svg>
                        <img src="PageIcons\receiveWhite.png">&emsp;Received Files
                    </a>
                </li>
                <li>
                    <a href="fileRequest.php" class="nav-link text-white font_family" style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">

                        </svg>
                        <!--#FCC419AD-->
                        <img src="PageIcons\requestWhite.png">&emsp;File Request
                    </a>
                </li>
            </ul>
            <hr>
            <div>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="logOut.php" class="nav-link text-white font_family" style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
                            <svg class="bi me-2" width="16" height="16">
                                <use xlink:href="#grid"></use>
                            </svg>
                            <img src="PageIcons\logoutWhite.png">&emsp;Log Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-10" style="background-color: #FAFAFA">
            <!-- Wrapper -->
            <div class="wrapper">
                <section class="container-fluid inner-page">
                    <div class="row">
                        <table class="table" style="margin-top: 40px; border-color: black;">
                            <thead class="thead-dark text-dark">
                                <tr style="background-color: #1f0838; color:#D4D4D4;">
                                    <!-- <th scope="col">Sr No.</th> -->
                                    <th scope="col">File Name</th>
                                    <th scope="col">Upload Time</th>
                                    <th scope="col">Upload Date</th>
                                    <th scope="col">Download</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['image']; ?></td>
                                        <td><?php echo $row['uploadTime']; ?></td>
                                        <td><?php echo $row['uploadDate']; ?></td>
                                        <td><button class="openButton" style="background-color: #1f0838; color: #FFFFFF; border-radius: 50px; width: 110px; height: 30px;" onclick="openForm(<?php echo $row['id']; ?>)" id="<?php echo $row['id']; ?>">Download</button></td>
                                    <tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <div class="loginPopup">
                            <div class="formPopup" id="popupForm">
                                <form action="#" class="formContainer" method="GET">
                                    <label for="key">
                                        <strong style="color: #FFFFFF">Enter Key to Decrypt</strong>
                                    </label>
                                    <input type="password" placeholder="Enter key" id="key" required>
                                    <button type="submit" class="btn" onclick="sendKey()">Decrypt and Download</button>
                                    <button type="button" class="btn cancel" onclick="closeForm()" style="color: #FFFFFF">Close</button>
                                </form>
                            </div>
                        </div>
                        <script>
                            var uid;

                            function openForm(id) {
                                document.getElementById("popupForm").style.display = "block";
                                uid = id;

                            }

                            function closeForm() {
                                document.getElementById("popupForm").style.display = "none";
                            }

                            function sendKey() {
                                $.ajax({
                                    type: "GET",
                                    url: 'verification.php',
                                    data: {
                                        userID: uid,
                                        key: document.getElementById('key').value
                                    },
                                    success: function(data) {
                                        document.getElementById("download").innerHTML = data;
                                        document.getElementById("link").click();
                                        closeForm();
                                    }
                                });
                            }
                        </script>


                    </div>
            </div>
        </div>
        <div id="download" style="display: none">
        </div>
    </div>
</body>

</html>

</div><!-- /End row -->
</section>
</div>
</div>
</div>
</body>

</html>