<div id="logo-admin-block"><img id="logo-admin-img" src='../<?php echo LOGO;?>' alt='' /></div>
<div id="login" class="col-md-4 col-md-offset-4 clearfix">
  <form method="post" class="form-signin" action="../lib/Execute.php?e=User/loginAdmin&back=1">
        <div class="input-group margin-bottom-sm">
            <span class="input-group-addon"><i class="fa fa-user fa-fw fa-2x"></i></span>
            <input class="input-text form-control" name="usr" type="text" placeholder="User" />
        </div>

        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-fw fa-2x"></i></span>
            <input class="input-text form-control" name="psw" type="password" placeholder="Password" />
        </div>
    <button class="btn btn-lg btn-primary btn-block login-btn"  type="submit">Login</button>
  </form>
</div>
<div class="clearfix"></div>