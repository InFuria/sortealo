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
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(isset($user) ? $user->name : old('name')); ?>" required autocomplete="name" autofocus>

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
    <label for="username" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Usuario o apodo</label>

    <div class="col-md-12">
        <input id="username" type="text" class="form-control form-control-lg <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(isset($user) ? $user->username : old('username')); ?>" required autocomplete="username" autofocus>

        <?php $__errorArgs = ['username'];
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
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(isset($user) ? $user->email : old('email')); ?>" required autocomplete="email" autofocus>

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
    <label for="phone" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Telefono</label>

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
    <label for="password" class="col-md-4 d-inline h4 text-md-left"><p class="text-danger d-inline">* </p>Contraseña</label>

    <div class="col-md-12">
        <input id="password" type="text" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" "<?php echo e(isset($user) ? '' : 'required'); ?>">

        <?php $__errorArgs = ['password'];
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
    <label for="role_id" class="col-md-4 d-inline h4 text-md-left"><p class="text-danger d-inline">* </p>Rol</label>

    <div class="col-md-12">
        <?php echo Form::select('role_id', $roles, null, ['placeholder' => 'Seleccione un rol',"name" => "role_id", "class"=> "form-control form-control-lg", "required", "autofocus"]); ?>


        <?php $__errorArgs = ['role_id'];
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
    <label for="photo" class="col-md-4 h4 d-inline text-md-left">Foto de perfil</label>

    <?php if(isset($user->photo)): ?>
        <a class="h6 font-italic" href="<?php echo e(isset($user) ? ( asset('storage/users/'.$user->photo)): ''); ?>" target="_blank">(Imagen actual)<i></i></a>
    <?php endif; ?>

    <div class="col-md-12">
        <input id="photo" type="file" class="form-control-lg <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="photo" value="<?php echo e(old('photo')); ?>" autocomplete="photo" autofocus>

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

<hr/>

<div class="col-12 pl-0">
    <span class="col-12 text-md-left pl-0 h6 text-danger font-weight-bold"><i>* Campo obligatorio </i></span>

    <br>

    <span class="text-md-left h6 ml-0 pb-5">**En caso de registrar a un administrador no es necesario asignarle una empresa.</span>
</div>


<div class="form-group row mt-5 mb-5">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
            <?php echo e($button); ?>

        </button>
    </div>
</div><?php /**PATH /home/vagrant/code/sortealo/resources/views/users/partials/_form.blade.php ENDPATH**/ ?>