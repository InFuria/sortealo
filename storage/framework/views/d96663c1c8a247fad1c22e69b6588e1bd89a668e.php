<?php $__env->startSection('title', 'Crear Empresa'); ?>

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
                        <h1 class="ml-3 p-2 special-title mx-auto">Registro de nueva empresa</h1>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center align-items-center col-8 mx-auto">
                    <?php echo Form::open(['route' => 'companies.store', 'method' => 'post', 'class' => 'col-md-10', 'files' => true]); ?>

                        <?php echo $__env->make('companies.partials._form', ['button' => 'Registrar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/companies/create.blade.php ENDPATH**/ ?>