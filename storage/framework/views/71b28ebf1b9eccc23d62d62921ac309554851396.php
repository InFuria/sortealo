<!-- La libreria Laravel Collective que se usa para el form ya genera automaticamente el input '_token' -->

<div class="row">
    <!-- Bloque derecho -->
    <div class="col-6 m-0 p-0">
        <div class="form-group">
            <label for="title" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Titulo</label>

            <div class="col-md-12">

                <input id="title" type="text" class="form-control form-control-lg <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e(isset($raffle) ? $raffle->title : old('title')); ?>" required autocomplete="title" autofocus>

                <?php $__errorArgs = ['title'];
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
            <label for="description" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Descripcion</label>

            <div class="col-md-12">
                <textarea id="description" rows="4" class="form-control form-control-lg <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" required autocomplete="description" autofocus><?php echo e(isset($raffle) ? $raffle->description : old('description')); ?></textarea>

                <?php $__errorArgs = ['description'];
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
    </div>

    <!-- Bloque izquierdo -->
    <div class="col-6 m-0 p-0">
        <div class="form-group">
            <label for="status" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Estado</label>

            <div class="col-md-12">
                <?php echo Form::select('status', [2 => 'Pendiente', 1 => 'En curso', 3 => 'Terminado', 4 => 'Cancelado'], null, ['placeholder' => 'Seleccione una estado',"name" => "status", "class"=> "form-control form-control-lg", "required", "autofocus"]); ?>


                <?php $__errorArgs = ['status'];
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

        <?php if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3): ?>
            <div class="form-group">
                <label for="company_id" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Empresa</label>

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
        <?php endif; ?>


        <div class="form-group">
            <label for="category_id" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Categoria</label>

            <div class="col-md-12">
                <?php echo Form::select('category_id', $categories, null, ['placeholder' => 'Seleccione una categoria',"name" => "category_id", "class"=> "form-control form-control-lg", "required", "autofocus"]); ?>


                <?php $__errorArgs = ['category_id'];
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
    </div>

    <!-- Bloque del medio -->
    <div class="row col-12 mt-4 p-0">
        <div class="form-group col-4 pr-0">
            <label for="start_date" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Fecha y hora de Inicio</label>

            <div class="col-md-12 pr-0">
                <input type="text" data-format="dd/MM/yyyy hh:mm:ss" id="start_date" name="start_date" class="form-control form-control-lg raffle-date" placeholder="Seleccione una fecha y hora de inicio" required autofocus>

                <?php $__errorArgs = ['start_date'];
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

        <div class="form-group col-4 pr-0">
            <label for="end_date" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Fecha y hora de Cierre</label>

            <div class="col-md-12 pr-0">
                <input type="text" id="end_date" name="end_date" class="form-control form-control-lg raffle-date" placeholder="Seleccione una fecha y hora de cierre" required autofocus>

                <?php $__errorArgs = ['end_date'];
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

        <div class="form-group col-4 pr-0">
            <label for="raffle_date" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p><p class="text-info d-inline">** </p>Fecha y hora de Sorteo</label>

            <div class="col-md-12 pr-0">
                <input type="text" id="raffle_date" name="raffle_date" class="form-control form-control-lg raffle-date" placeholder="Seleccione una fecha y hora para realizar el sorteo" required autofocus>

                <?php $__errorArgs = ['raffle_date'];
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
    </div>

    <!-- Bloque inferior -->
    <div class="row col-12 mt-4 p-0">
        
        <div class="form-group col-4">
            <label for="quantity_tickets" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Tickets habilitados</label>

            <div class="col-md-12">
                <input id="quantity_tickets" type="number" class="form-control form-control-lg <?php $__errorArgs = ['quantity_tickets'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="quantity_tickets" value="<?php echo e(isset($raffle) ? $raffle->quantity_tickets : old('quantity_tickets')); ?>" required autocomplete="quantity_tickets" autofocus>

                <?php $__errorArgs = ['quantity_tickets'];
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

        <div class="form-group col-4">
            <label for="cost_per_ticket" class="col-md-4 h4 d-inline text-md-left"><p class="text-danger d-inline">* </p>Costo de cada ticket</label>

            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon">$</div>
                    </div>
                    <input id="cost_per_ticket" type="number" class="form-control form-control-lg <?php $__errorArgs = ['cost_per_ticket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="cost_per_ticket" value="<?php echo e(isset($raffle) ? $raffle->cost_per_ticket : old('cost_per_ticket')); ?>" required autocomplete="cost_per_ticket" autofocus>
                </div>

                <?php $__errorArgs = ['cost_per_ticket'];
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

        <div class="form-group mt-2">
            <label for="multiple_winners" class="col-md-4 h4 d-inline text-md-left">Multiples ganadores</label>

            <div class="form-check d-flex d-inline col-md-12 ml-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="multiple_winners" data-type="1" id="multiple_winnersOn" value="1" <?php echo e(isset($raffle) ? ($raffle->multiple_winners == 1 ? 'checked' : '') : ''); ?> autofocus>
                    <label class="form-check-label" for="inlineRadio1">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="multiple_winners" data-type="0" id="multiple_winnersOff" value="0" <?php echo e(isset($raffle) ? ($raffle->multiple_winners == 0 ? 'checked' : '') : ''); ?> <?php echo e(!isset($raffle) ? 'checked' : ''); ?> autofocus>
                    <label class="form-check-label" for="inlineRadio2">No</label>
                </div>

                <input id="extra_winners" type="number" class="col-3 form-control form-control-lg <?php $__errorArgs = ['extra_winners'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="extra_winners" value="<?php echo e(isset($raffle) ? $raffle->extra_winners : 0); ?>" <?php echo e(isset($raffle) ? ($raffle->extra_winners <= 0) ? 'disabled' : '' : 'disabled'); ?> required autocomplete="extra_winners" autofocus>

                <?php $__errorArgs = ['multiple_winners'];
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

                <?php $__errorArgs = ['extra_winners'];
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

        <div class="form-group col-12 mt-4">
            <label for="images" class="col-md-4 h4 d-inline text-md-left">Imagenes adjuntas <i class="h6 text-danger">(Minimo 300px ancho y 300px de alto)</i></label>

            <div class="col-md-12">
                <input id="images" type="file" class="form-control-lg <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="images[]" value="<?php echo e(old('images')); ?>" multiple="multiple" autocomplete="images" autofocus>

                <?php $__errorArgs = ['images'];
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

            <div class="row col-12 mt-4">
                <?php if(isset($raffle) ? !$raffle->files->isEmpty() : false): ?>
                    <?php $__currentLoopData = $raffle->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-2 d-flex m-3 my-auto border border-danger rounded p-2">
                            <img src="<?php echo e(asset('storage/raffles/' . $image->name)); ?>" class="img-fluid mx-auto img-thumbnail d-inline" style="position:relative;max-height: 150px;"/>
                            <a type="button" class="btn-delete-image bg-danger text-center text-white rounded-bottom" data-id="<?php echo e($image->id); ?>" title="Eliminar imagen" style="width: 22px; height: 22px; position:absolute;right:0;top:0;border-bottom-right-radius:0 !important; text-decoration: none;"><b>x</b></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<hr/>

<div class="col-12 pl-0">
    <span class="col-12 text-md-left pl-0 h6 text-danger font-weight-bold"><i>* Campo obligatorio </i></span>

    <br>
    
    <span class="col-12 pt-5 text-md-left pl-0 h6 text-info font-weight-bold"><i>** Este campo ofrece la opcion de realizar el sorteo en un dia diferente al de cierre, si desea que el sorteo se realice al cierre solo seleccione el mismo dia y hora que el campo de "Fecha y hora de Cierre"</i></span>
    
</div>

<div class="form-group row mt-5 mb-5">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #1e3d59; border-color:#1e3d59;">
            <?php echo e($button); ?>

        </button>
    </div>
</div><?php /**PATH /home/vagrant/code/sortealo/resources/views/raffles/partials/_form.blade.php ENDPATH**/ ?>