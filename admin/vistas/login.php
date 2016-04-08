<div class="row mtop-100">
    <div class="col-md-4 col-md-offset-4 clearfix bg--dark">

        <div class="main-logo"><div id="logo-admin-block"><img id="logo-admin-img" src='../<?php echo LOGO;?>' alt='' /></div>

            <p>Welcome to Admin efphp</p>
        </div>
        <form method="post" id="login-form" action="../lib/Execute.php?e=User/loginAdmin&back=1">
            <div class="input-group">
                <span class="input-group-addon"><i class="pe-7f-user pe-fw"></i></span>
                <input type="text" class="input-text form-control" placeholder="Username" name="usr" />
            </div>
            <div class="input-group mtop-25">
                <span class="input-group-addon"><i class="pe-7f-lock pe-fw"></i></span>
                <input type="password" class="input-text form-control" placeholder="Password" name="psw" />
            </div>
            <div class="clearfix"></div>
            <a href="#"  id="submit-login" class="btn btn-skyblue pull-right">Login</a>
        </form>

    </div>
</div>
