<?php include('session_manager.php');
$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Bootstrap\bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Julee">
    <link id="onyx-css" href="sidebar_css.css" rel="stylesheet">
    <title>Dashboard-AtreyaShield</title>
    <style>
        .full-dark-bg {
            background-color: #D4D4D4;
        }

        .font_family{
            font-weight: 900;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
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
                    <a href="myFiles.php" class="nav-link font_family text-white" aria-current="page" style="font-size: 15px; padding-left: 0px; padding-bottom: 10px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
                         <img src="PageIcons\homeWhite.png">&emsp;My Files
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link font_family" style="font-size: 18px; background-color: #FAFAFA; color: black; width: 110%; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
                        &nbsp;<img src="PageIcons\uploadFilesBlack.png">&emsp;Upload Files
                    </a>
                </li>
                <li>
                    <a href="receivedFiles.php" class="nav-link text-white font_family"
                    style="font-size: 17px; width: 110%; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
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

                        <div class="col-xl-6 offset-xl-3 col-lg-6 offset-lg-3 col-md-12 full-dark-bg" style="color: black;">

                            <!-- Files section -->
                            <h4 class="section-sub-title"  style="color: black;"><span>Upload</span> Your Files</h4>

                            <form method="post" enctype="multipart/form-data" class="dropzone files-container"  style="color: black;">
                                <div class="fallback">


                                    <input name="file" type="file">
                                    <br><br>
                                    <input type="password" placeholder="Enter private key" name="prkey" min="5" required><br><br>
                                    <button name="submit">Upload File</button>
                                </div>
                            </form>

                            <span style="color: black;">Only JPG, PNG, PDF, DOC (Word), XLS (Excel), PPT, ODT and RTF files types are supported.</span>
                            <span  style="color: black;">Maximum file size is 25MB.</span>



                            <div id="warnings">
                                <span>Warnings will go here!</span>
                            </div>

                        </div>
                    </div><!-- /End row -->

                </section>

            </div>
        </div>
    </div>
</body>

</html>

<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "atreyashield";


// Create database connection
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

define('SITE_ROOT', realpath(dirname(__FILE__)));

if (isset($_POST["submit"])) {
    $pname = $_FILES["file"]["name"];
    $t_name = $_FILES["file"]["tmp_name"];
    $privateKey = $_POST["prkey"];

    include('aes-enc.php');
    date_default_timezone_set("Asia/Kolkata");
    $time = date('h:i:sa');
    $date = date('y-m-d');
    $filetime = date('hisa');
    $filedate = date('ymd');
    encryptFile('E:/SEM 6/NS/Practical7/' . $pname, 'serverupload/' . $filedate . $filetime . "_encrypted" . $pname, '*&@zxor)#^!+=]' . $privateKey . ')#^!+=]*&@zxor');

    move_uploaded_file($t_name, 'serverupload/' . $filedate . $filetime . "_encrypted" . $pname);
    $encrypted_filename = ($filedate . $filetime . "_encrypted" . $pname);
    #sql query to upload
    $sql = "INSERT into files(`image`, `owner_id`,`uploadTime`,`uploadDate`,`privateKey`) VALUES('$encrypted_filename','$user_id','$time','$date','$privateKey')";

    if (mysqli_query($db, $sql)) {
        echo "File Successfully Uploaded";
    } else {
        echo "File not uploaded. Please try again";
    }
}

?>