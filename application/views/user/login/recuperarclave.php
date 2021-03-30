<form class="" action="<?=base_url()?>User/resetearClave" method="post">

<div class="fp-box">
    <div class="card">
        <div class="body">
            <form id="forgot_password" method="POST">
                <div class="msg">

Ingrese su dirección de correo electrónico que utilizó para registrarse. Te enviaremos un correo electrónico con tu nombre de usuario y un enlace para restablecer tu contraseña..
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="correo" placeholder="Email" required autofocus>
                    </div>
                </div>

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESETEAR MI CLAVE</button>

                <div class="row m-t-20 m-b--5 align-center">
                    <a href="<?=base_url()?>">Regresar!</a>
                </div>
            </form>
        </div>
    </div>
</div>
</form>
