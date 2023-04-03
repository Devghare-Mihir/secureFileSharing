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
                    <a href="myFiles.php" class="nav-link text-white font_family" aria-current="page"
                        style="font-size: 15px; padding-left: 0px; padding-bottom: 10px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
                        <img src="PageIcons\homeWhite.png">&emsp;My Files
                    </a>
                </li>
                <li>
                    <a href="uploadFiles.php" class="nav-link text-white font_family"
                    style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
                        <img src="PageIcons\uploadFilesWhite.png">&emsp;Upload Files
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link font_family"
                    style="font-size: 18px; background-color: #FAFAFA; color: black; width: 110%; padding-left: 0px; margin-top: 15px;">
                        <svg class="bi me-2" width="16" height="16">
                        </svg>
                        &nbsp;<img src="PageIcons\receiveBlack.png">&emsp;Received Files
                    </a>
                </li>
                <li>
                    <a href="fileRequest.php" class="nav-link text-white font_family"
                    style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
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
                        <a href="logOut.php" class="nav-link text-white font_family"
                        style="font-size: 15px; padding-left: 0px; margin-top: 15px;">
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
                        <!--HERE UR CODE WILL BE THERE-->
                        
                    </div><!-- /End row -->
                </section>
            </div>
        </div>
    </div>
</body>

</html>