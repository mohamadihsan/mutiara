<?php  
$session_nip = $_SESSION['session_nip'];
$sql = "SELECT pegawai.id, nip, nama_lengkap, nama_panggilan, jabatan, nama_pengguna FROM pegawai WHERE pegawai.nip='$session_nip'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$nip = $row['nip'];
$nama_lengkap = $row['nama_lengkap'];
$nama_panggilan = $row['nama_panggilan'];
$jabatan = $row['jabatan'];
$nama_pengguna = $row['nama_pengguna'];
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="opacity: 0">
        Profil
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-success">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="assets/images/user.png" alt="No Image">

              <h3 class="profile-username text-center"><?= strtoupper($_SESSION['session_nama_lengkap']) ?></h3>

              <p class="text-muted text-center"><?= strtoupper($_SESSION['session_jabatan']) ?></p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Data Pribadi</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#settings" data-toggle="tab">Data Akun</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form method="post" action="" class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nomor Induk</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nip" id="nip" value="<?= $nip ?>" placeholder="Nomor Induk" readonly="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= strtoupper($nama_lengkap) ?>" placeholder="Nama Lengkap" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Panggilan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_panggilan" id="nama_panggilan" value="<?= strtoupper($nama_panggilan) ?>" placeholder="Nama Panggilan" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Jabatan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= strtoupper($jabatan) ?>" placeholder="jabatan" readonly="">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="ubah_profil" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form method="post" action="" class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Pangguna</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?= $nama_pengguna ?>" placeholder="Nama Pengguna" required="">
                    </div> 
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Kata Sandi</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="Kata Sandi" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="ubah_kata_sandi" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper

  <!-- Pesan Proses Ubah  -->
<?php  
if (isset($_SESSION['ubah_berhasil'])) {
  ?>
    <script type="text/javascript">
    $(function(){
      $.gritter.add({
          // (string | mandatory) the heading of the notification
          title: 'Sukses!',
          // (string | mandatory) the text inside the notification
          text: 'Data berhasil diperbaharui.',
          // (string | optional) the image to display on the left
          image: 'assets/images/berhasil.png',
          // (bool | optional) if you want it to fade out on its own or just sit there
          sticky: false,
          // (int | optional) the time you want it to be alive for before fading out
          time: ''
        });
    });
  </script>
    <?php
    /*unset session*/
    unset($_SESSION['ubah_berhasil']);
}else if (isset($_SESSION['ubah_gagal'])) {
  ?>
    <script type="text/javascript">
    $(function(){
      $.gritter.add({
          // (string | mandatory) the heading of the notification
          title: 'Gagal!',
          // (string | mandatory) the text inside the notification
          text: 'Error : Terjadi kesalahan saat memperbaharui data.',
          // (string | optional) the image to display on the left
          image: 'assets/images/gagal.png',
          // (bool | optional) if you want it to fade out on its own or just sit there
          sticky: false,
          // (int | optional) the time you want it to be alive for before fading out
          time: ''
        });
    });
  </script>
    <?php
    /*unset session*/
    unset($_SESSION['ubah_gagal']);
}
?>