<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="middle-box text-center loginscreen animated fadeInDown">
		<div>
				<div>

						<h1 class="logo-name">
<img class="img-responsive" src="<?=base_url()?>images/logoAB.png" alt="">
						</h1>

				</div>
				<?= form_open("user/ingresar") ?>
						<div class="form-group">
								<input type="text" class="form-control" name="usuario" placeholder="Usuario" required="">
						</div>
						<div class="form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" required="">
						</div>

							<div class="">
								<?php if (validation_errors()) : ?>
									<div class="col-md-12">
										<div class="alert alert-danger" role="alert">
											<?= validation_errors() ?>
										</div>
									</div>
								<?php endif; ?>
								<button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>
									<?php if (isset($error)) : ?>
										<div class="">
											<div class="alert alert-danger" role="alert">
												<?= $error ?>
											</div>
										</div>
								<?php endif; ?>
							</div>
						<a href="#" style="display:none;"><small>Forgot password?</small></a>
						<p class="text-muted text-center" style="display:none;" ><small>Do not have an account?</small></p>
						<a class="btn btn-sm btn-white btn-block" href="register.html" style="display:none;" >Create an account</a>
				</form>
				<p class="m-t"> <small>Derechos reservados American BUS © &copy; <?=date("Y");?></small> </p>
		</div>
</div>