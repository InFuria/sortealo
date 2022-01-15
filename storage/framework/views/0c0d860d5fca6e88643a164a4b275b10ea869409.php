<?php $__env->startSection('title', 'Contacto'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Solicitud de contacto</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center col-8 mt-5 mx-auto">
                    <?php echo Form::open(['route' => 'contact.send', 'method' => 'post', 'class' => 'col-md-10', 'files' => true]); ?>


                    <!-- La libreria Laravel Collective que se usa para el form ya genera automaticamente el input '_token' -->
                    <div class="form-group">
                        <label for="name" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Nombre completo</label>

                        <div class="col-md-12">

                            <input id="name" type="text" class="form-control form-control-lg <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>

                            <?php $__errorArgs = ['name'];
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
                        <label for="email" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Email</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                            <?php $__errorArgs = ['email'];
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
                        <label for="phone" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline"> </p>Telefono</label>

                        <div class="col-md-12">
                            <input id="phone" type="text" class="form-control form-control-lg <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e(isset($user) ? $user->phone : old('phone')); ?>" required autocomplete="phone" autofocus>

                            <?php $__errorArgs = ['phone'];
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
                        <label for="reason" class="col-md-4 h4 text-md-left"><p class="text-danger d-inline">* </p>Motivo de contacto</label>

                        <div class="col-md-12">
                            <?php echo Form::select('reason', ['Consultas' => 'Consultas', 'Problemas con la pagina' => 'Problemas con la pagina', 'Problemas con pagos' => 'Problemas con pagos', 'Unirse como empresa' => 'Unirse como empresa', 'Otros problemas tecnicos' => 'Otros problemas tecnicos'], 
                                \Request::has('unirse') == true ? 3 : null, ['placeholder' => 'Seleccione un motivo',"name" => "reason", "class"=> "form-control form-control-lg", "required", "autofocus"]); ?>


                            <?php $__errorArgs = ['reason'];
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
                        <label for="message" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Consulta</label>

                        <div class="col-md-12">

                            <textarea rows="7" id="message" type="text" class="form-control form-control-lg <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" value=" old('message') }}" required autocomplete="message" autofocus></textarea>

                            <?php $__errorArgs = ['name'];
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

                    <hr/>

                    <div class="form-group row mt-5 mb-5">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
                                Enviar
                            </button>
                        </div>
                    </div>                        

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/layouts/contact.blade.php ENDPATH**/ ?>