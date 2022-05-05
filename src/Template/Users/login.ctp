<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->


<!------ podemos crear el archivo login.cc en webroot/css o meter el css en etiquetas style ---------->

<?= $this->Html->css('login') ?> 

<style>
.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>
<div class="container">

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <?= $this->Flash->render('auth') ?>   <!--  para poder mostrar los mensajes flash -->
        <?= $this->Form->create() ?>   <!--  iniciamos el formulario -->
		<form role="form">
			<fieldset>
				<h2>Ingresa</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    <!-- <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address"> -->
                    <?= $this->Form->control('email', ['class' => 'form-control input-lg' , 'placeholder' => 'Correo electronico' , 'label' => false, 'required']) ?>
				</div>
				<div class="form-group">
                    <!-- <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password"> -->
                    <?= $this->Form->control('password', ['class' => 'form-control input-lg' , 'placeholder' => 'Contraseña' , 'label' => false, 'required']) ?>
				</div>
				<!-- <span class="button-checkbox">
					<button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
					<a href="" class="btn btn-link pull-right">Forgot Password?</a>
				</span> -->
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <!-- <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In"> -->
                        <?= $this->Form->button(__('Acceder'), ['class' => 'btn btn-lg btn-success btn-block']) ?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<!-- <a href="" class="btn btn-lg btn-primary btn-block">Register</a> -->
                        <?= $this->Html->link(__('Registrarse'), ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-lg btn-primary btn-block']) ?>
					</div>
				</div>
			</fieldset>
		</form>
        <?= $this->Form->end() ?>
	</div>
</div>

</div>