<?php $__env->startSection('title', 'Ingreso'); ?>

<?php $__env->startSection('style'); ?>
    <style>
    a:hover {
        color: #ff6e40;
    }
    
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid h-100 mt-5">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-9 col-md-9 col-lg-7 col-xl-5">
            <div class="card" style="background-color: #f5f0e1;">
                <h1 class="text-center pt-5 mb-5" style="font-weight: bold; color: #ff6e40">Bienvenido a Sortealo</h4>

                <div class="card-body d-flex justify-content-center">
                    <form method="POST" class="col-md-10" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="username" class="col-md-4 h4 text-md-left">Usuario</label>

                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control form-control-lg <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 h4 text-md-left">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="password" class="col-md-4 h4 text-md-left">Empresa</label>

                        <div class="col-md-12">
                            <?php echo Form::select('company_id', $companies, null, ['placeholder' => 'Seleccione una empresa',"name" => "company_id", "class"=> "form-control form-control-lg", "required", "autofocus"]); ?>


                            <?php $__errorArgs = ['company_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="captcha" class="col-md-4 h4 text-md-left">Captcha</label>
                            <div class="col-md-12">
                            <?php echo htmlFormSnippet(); ?>

                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-12 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                    <label class="form-check-label h4" for="remember">
                                        Mantener sesion activa
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
                                    Ingresar
                                </button>
                            </div>
                            <div class="col-md-12">
                                <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link btn-lg btn-block" id="forgot" href="<?php echo e(route('password.request')); ?>" style="color:#1e3d59;">
                                       Olvidaste tu contraseña
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>
                <span class="text-left h6 ml-3">*Este formulario es exclusivo para empresas, para unirse a nuestro equipo contactenos <a href="<?php echo e(route('contact.index')); ?>?unirse">aqui</a>.</span>
                <span class="text-left h6 ml-3">**En caso de querer participar en uno de los sorteos acceda <a href="/">aqui</a>.</span>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/auth/login.blade.php ENDPATH**/ ?>