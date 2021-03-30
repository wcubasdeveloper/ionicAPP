<form class="" action="<?=base_url()?>User/setnuevaclave" method="post">

<div class="fp-box">
    <div class="card">
        <div class="body">
            <form id="forgot_password" method="POST">
                <div class="msg">
                  Cambio de contraseña
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="hidden" name="vresetclave" value="<?=$vreset?>">
                        <input type="password" class="form-control" name="nuevaclave" placeholder="Ingresar clave" required autofocus>
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" name="renuevaclave"  class="form-control" placeholder="repetir clave" required autofocus>
                    </div>
                </div>
                <?php if (isset($error)) : ?>
                <div class="col-md-12">
                  <div class="alert alert-danger" role="alert">
                    <?=$error?>
                  </div>
                </div>
                <?php endif; ?>
                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">CAMBIAR CLAVE</button>
            </form>
        </div>
    </div>
</div>
</form>
