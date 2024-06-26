<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Doctors</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login.php");
    }
    
    include("../connection.php");
    $userrow = $database->query("select * from patient where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Keluar" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
<<<<<<< HEAD
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Dashboard</p></a></div></a>
=======
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home">
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Home</p></a></div>
>>>>>>> 61e4e5250f69226c3c1bbe3093ce16e55015d0e8
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor menu-active menu-icon-doctor-active">
                        <a href="doctors.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Daftar Dokter</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Jadwal Dokter</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Booking Saya</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-settings">
                        <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;margin-top:25px;">
                <tr>
                    <td width="13%">
                        <a href="doctors.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Kembali</font></button></a>
                    </td>
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Cari Nama Dok" list="doctors">&nbsp;&nbsp;
                            <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("select docname, docemail from doctor;");
                                for ($y=0; $y<$list11->num_rows; $y++) {
                                    $row00 = $list11->fetch_assoc();
                                    $d = $row00["docname"];
                                    $c = $row00["docemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                }
                                echo '</datalist>';
                            ?>
                            <input type="submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                                date_default_timezone_set('Asia/Kolkata');
                                $date = date('Y-m-d');
                                echo $date;
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Daftar Dokter (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        $sqlmain= "select * from doctor where docemail='$keyword' or docname='$keyword' or docname like '$keyword%' or docname like '%$keyword' or docname like '%$keyword%'";
                    } else {
                        $sqlmain= "select * from doctor order by docid desc";
                    }
                ?>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Nama Dokter</th>
                                        <th class="table-headin">Email</th>
                                        <th class="table-headin">Spesialis</th>
                                        <th class="table-headin">Acara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result= $database->query($sqlmain);
                                        if($result->num_rows==0){
                                            echo '<tr>
                                            <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                            <img src="../img/notfound.svg" width="25%">
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Kami tidak dapat menemukan apa pun yang berhubungan dengan kata kunci Anda!</p>
                                            <a class="non-style-link" href="doctors.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Tampilkan Daftar Dokter &nbsp;</font></button></a>
                                            </center>
                                            <br><br><br><br>
                                            </td>
                                            </tr>';
                                        } else {
                                            for ($x=0; $x<$result->num_rows; $x++){
                                                $row=$result->fetch_assoc();
                                                $docid=$row["docid"];
                                                $name=$row["docname"];
                                                $email=$row["docemail"];
                                                $spe=$row["specialties"];
                                                $spcil_res= $database->query("select sname from specialties where id='$spe'");
                                                $spcil_array= $spcil_res->fetch_assoc();
                                                $spcil_name=$spcil_array["sname"];
                                                echo '<tr>
                                                    <td>&nbsp;'.substr($name,0,30).'</td>
                                                    <td>'.substr($email,0,20).'</td>
                                                    <td>'.substr($spcil_name,0,20).'</td>
                                                    <td>
                                                    <div style="display:flex;justify-content: center;">
                                                    <a href="?action=view&id='.$docid.'" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-view" style="padding:12px 40px;margin-top: 10px;">Lihat</button></a>
                                                    &nbsp;&nbsp;&nbsp;
                                                    <a href="?action=drop&id='.$docid.'&name='.$name.'" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-delete" style="padding:12px 40px;margin-top: 10px;">Hapus</button></a>
                                                    </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </center>
                   </td>
                </tr>
            </table>
        </div>
    </div>

    <?php
    $action = ''; // Initialize the action variable
    $id = '';

    if ($_GET) {
        $id = isset($_GET["id"]) ? $_GET["id"] : '';
        $action = isset($_GET["action"]) ? $_GET["action"] : '';
    }

    if($action=='drop'){
        $nameget=$_GET["name"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Apa kamu yakin?</h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        Anda ingin menghapus catatan ini<br>('.substr($nameget,0,40).').
                    </div>
                    <div style="display: flex;justify-content: center;">
                    <a href="delete-doctor.php?id='.$id.'" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;Ya&nbsp;</button></a>&nbsp;&nbsp;&nbsp;
                    <a href="doctors.php" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;Tidak&nbsp;</button></a>
                    </div>
                </center>
            </div>
        </div>
        ';
    } elseif($action=='view'){
        $sqlmain= "select * from doctor where docid='$id'";
        $result= $database->query($sqlmain);
        $row=$result->fetch_assoc();
        $name=$row["docname"];
        $email=$row["docemail"];
        $spe=$row["specialties"];
        $spcil_res= $database->query("select sname from specialties where id='$spe'");
        $spcil_array= $spcil_res->fetch_assoc();
        $spcil_name=$spcil_array["sname"];
        $tele=$row['doctel'];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Rincian</h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        ID Pengguna: '.$id.'<br>
                        Nama: '.$name.'<br>
                        Email: '.$email.'<br>
                        Spesialis: '.$spcil_name.'<br>
                        Kontak: '.$tele.'<br>
                    </div>
                    <div style="display: flex;justify-content: center;">
                    <a href="doctors.php" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">&nbsp;OK &nbsp;</button></a>
                    </div>
                </center>
            </div>
        </div>
        ';
    }
    ?>
</body>
</html>
