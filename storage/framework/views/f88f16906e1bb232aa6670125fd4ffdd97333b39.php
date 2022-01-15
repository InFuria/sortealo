<?php $__env->startSection('title', 'Preguntas Frecuentes'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .list-group-item{
        color: black;
        text-decoration: none !important;
        font-size: 1.2rem;
    }

    li:hover{
        background-color: rgb(255,110,64, .7);
    }
    
    .btn-back{
        background-color: #1e3d59; 
        border-color: #1e3d59;
        color: white;
    }

    .btn-back:hover{
        background-color: rgb(255,110,64, .7);
        border-color: rgb(255,110,64, .7);
        color: white;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

            <?php if(isset($categories) && !$categories->isEmpty()): ?>
                <div class="row">
                    <div class="col-12 text-center mt-5">
                        <h1 class="ml-3 p-2 special-title mx-auto">Preguntas frecuentes</h1>
                    </div>
                </div>

                <h3 class="mx-auto">Categorias</h3>
                <div class="card-body col-11 mx-auto">
                    <div class="row col-12 ml-5 ">
                        <div class="card my-2 p-2 rounded col-12">
                            <ul class="list-group">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(count($category->faqs) > 0): ?>
                                        
                                        <a class="list-group-item" href="faqs?categoria=<?php echo e($category->name); ?>"><?php echo e($category->name); ?></a>
                                        
                                    <?php endif; ?>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php elseif(isset($faqs) && $faqs !== []): ?>

                <div class="row">
                <a class="btn btn-back btn-sm col-1 m-2" href="/faqs">Volver</a>
                    <div class="col-12 text-center mt-3">
                        <h1 class="ml-3 p-2 special-title mx-auto">Preguntas frecuentes</h1>
                    </div>
                </div>

                <h3 class="mx-auto"><?php echo e($faqs->name); ?></h3>
                <div class="card-body col-11 mx-auto">
                    <div class="row col-12 ml-5 ">
                        <div class="card my-2 p-2 rounded col-12">
                            <ul class="list-group">
                               <?php $__currentLoopData = $faqs->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item">
                                    <h4> <i class="fas fa-minus-square" style="font-size: 16px !important"></i> <?php echo e($faq->question); ?></h4>
                                    <p><?php echo e($faq->answer); ?></p>
                                </div>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <div class="text-center mt-5"><h1>No se han encontrado preguntas publicadas</h1></div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
 // Prevents menu from closing when clicked inside
 document.getElementById("Dropdown").addEventListener('click', function (event) {
            alert("click outside");
            event.stopPropagation();
        });
</script>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/faqs/index.blade.php ENDPATH**/ ?>