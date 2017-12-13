<div class="login-box">
  <!-- <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div> -->
  <!-- /.login-logo -->
  <div class="login-box-body">
    <center>
      <h3>Lupa Kata Sandi</h3>
      <img src="assets/images/logo.png" alt="" class="img-responsive">
    </center>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!-- <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-block btn-flat" style="background-color: #00a207;color: #ffffff;" name="reset">Reset</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="./">Kembali</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->    

<!-- Pesan Proses Login Gagal  -->
<?php if (isset($_SESSION['error_login'])) {
  ?>
    <script type="text/javascript">
    $(function(){
      $.gritter.add({
          // (string | mandatory) the heading of the notification
          title: 'Gagal!',
          // (string | mandatory) the text inside the notification
          text: 'Error : Nama pengguna dan Kata sandi tidak terdaftar.',
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
    unset($_SESSION['error_login']);
}
?>