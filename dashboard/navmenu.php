<div class="wrapper">
  <header class="main-header hidden-print">
    <a class="logo"
    style="font-size:13pt; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
    <img src="#" height="30px" alt="" srcset="">
    <span style="margin-left: 5px;">Aplikasi Pengaman Surat</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
    <div class="navbar-custom-menu">
      <ul class="top-nav">
                    <!-- <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sign-out fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Keluar</a></li>
                </ul> -->
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <?php
            include '../config.php';

            $userdata = mysqli_query($connect, "SELECT * FROM users WHERE username = '$last'");
            $data = mysqli_fetch_array($userdata);
            if ($data['img'] != NULL) {
              $img = $data['img'];
            } else {
              $img = "default.png";
            }
            ?>
            <div class="pull-left image"><img class="img-circle" src="../assets/images/user/<?php echo $img; ?>"
              alt="User Image"></div>
              <div class="pull-left info">
                <p style="margin-top:-5px;"><?php echo $data['username']; ?></p>
                <p class="designation"><?php echo $data['job_title']; ?></p>
                <p class="designation" style="font-size:6pt;">Aktivitas Terakhir:
                  <?php echo $data['last_activity'] ?></p>
                </div>
              </div>
              <ul class="sidebar-menu">
                <?php
                $v = $_SESSION['username'];
                $query = mysqli_query($connect, "SELECT * FROM users WHERE username='$v'");
                $users = mysqli_fetch_array($query);
                if ($users['status'] == 1) {
                  ?>
                  <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Beranda</span></a></li>
                  <?php
                }elseif($users['status'] == 2){
                  ?>
                  <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Beranda</span></a></li>
                  <?php
                }
                ?>
                <?php
        if ($users['status'] == 1) { // Khusus Level 1
          echo '<li class="treeview"><a href="#"><i class="fa fa-file-o"></i><span>Berkas</span><i class="fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a href="encrypt.php"><i class="fa fa-circle-o"></i> Enkripsi Berkas</a></li>
          <li><a href="decrypt.php"><i class="fa fa-circle-o"></i> Dekripsi Berkas</a></li>
          </ul>
          </li>';
        } elseif ($users['status'] == 2) {
          echo '<li class="treeview"><a href="#"><i class="fa fa-file-o"></i><span>Berkas</span><i class="fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <li><a href="encrypt.php"><i class="fa fa-circle-o"></i> Enkripsi Berkas</a></li>
          <li><a href="decrypt.php"><i class="fa fa-circle-o"></i> Dekripsi Berkas</a></li>
          </ul>
          </li>';
        } else {
          echo "";
        }
        ?>

        <!-- <li><a href="history.php"><i class="fa fa-folder"></i><span>Daftar Berkas</span></a></li> -->
        <?php
        if ($users['status'] == 2) {
          ?>
          <li><a href="from_send.php"><i class="fa fa-envelope-o"></i><span>Kirim Email</span></a></li>
          <?php
        }
        ?>

        <?php
        if ($users['status'] == 1) {
          ?>
          <!-- <li><a href="userdata.php"><i class="fa fa-user"></i><span>Data User</span></a></li> -->
          <?php
        }
        ?>
        
        <li><a href="profile.php?id=<?php echo $_SESSION['username']; ?>"><i class="fa fa-cog"></i><span>Ubah
        Profil</span></a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i><span>Logout</span></a></li>

      </ul>

    </section>
  </aside>