<?php $__env->startSection('title', 'Editar Pregunta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
            <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Actualizacion de pregunta frecuente</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center col-8 mx-auto">
                    <?php echo Form::model($faq, ['route' => ['faqs.update', $faq->id], 'method' => 'post', 'class' => 'col-md-10']); ?>

                        <?php echo method_field('PUT'); ?>
                        <?php echo $__env->make('faqs.partials._form', ['button' => 'Actualizar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/faqs/edit.blade.php ENDPATH**/ ?>