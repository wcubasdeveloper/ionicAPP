<style media="screen">
	.input-group{
		margin-bottom: 6px;
	}

	.form-group{
    margin-bottom: 5px;
	}

	.col-sm-6{
		margin-bottom: 9px;
	}
</style>

<div class="signup-box">
        <div class="card">
            <div class="body">
                	<?= form_open() ?>
                    <div class="msg text-center">Registrar Nuevo Usuario</div>
										<br>
                    <div class="input-group">
                        <div class="form-line">
                            <input type="text" class="form-control" name="nombres" placeholder="Nombres" required autofocus>
                        </div>
                    </div>
										<div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="apepat" class="form-control" placeholder="A. Paterno" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="apemat" class="form-control" placeholder="A. Materno" required />
                                </div>
                            </div>
                        </div>
                    </div>

										<div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="textdni" onkeypress="return Util.SoloNumero(event, this);" class="form-control" placeholder="DNI" required  />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="telefono" onkeypress="return Util.SoloNumero(event, this);" class="form-control" placeholder="Teléfono" required />
                                </div>
                            </div>
                        </div>
                    </div>

										<div class="input-group">
												<span class="input-group-addon">
														<i class="material-icons">person</i>
												</span>
												<div class="form-line">
														<input type="text" class="form-control" name="nombreusuario" placeholder="Usuario" required  >
												</div>
										</div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="claveusuario" minlength="6" placeholder="Clave" required >
                        </div>
                    </div>

										<div class="input-group">
												<span class="input-group-addon">
														<i class="material-icons">email</i>
												</span>
												<div class="form-line">
														<input type="email" class="form-control" name="correousuario" placeholder="Email" required >
												</div>
										</div>
										<br>
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">REGISTRAR</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="<?=base_url()?>">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
