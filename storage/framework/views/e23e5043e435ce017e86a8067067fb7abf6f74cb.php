<?php $__env->startSection('title', 'Preguntas Frecuentes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card bg-light col-12 min-vh-100 my-5">

                <!-- start -->
              
                <div class="row">
                    <div class="mt-4 mb-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Preguntas Frecuentes</h1>
                        <a class="d-inline" href="<?php echo e(route('faqs.create')); ?>" title="Crear Pregunta">
                            <i class="far fa-plus-square fa-2x"></i>
                        </a>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                <table class="table table-hover mb-0" id="faqs-table">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th class="text-center">Respuesta</th>
                                            <th class="text-center">Categoria</th>
                                            <th class="text-center">Fecha de registro</th>
                                            <th class="action text-right pr-4">Opciones</th>
                                        </tr>
                                    </thead>

                                    <div class="input-group rounded">
                                        <input type="search" class="form-control border-right-0" id="search-faq" placeholder="Ingresa una pregunta o respuesta" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>

                                    <tbody class="user-container">
                                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="candidates-list">
                                                <td class="col-2">
                                                    <p><?php echo e($faq->question); ?></p>
                                                </td>
                                                <td class="col-6">
                                                    <p><?php echo e($faq->answer); ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <?php if(isset($faq->category)): ?>
                                                        <a href="#" class="badge badge-info text-white"><?php echo e($faq->category->name); ?></a>
                                                    <?php else: ?>
                                                        <a href="#" class="badge badge-secondary">No definido</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo e($faq->created_at); ?>

                                                </td>
                                                <td>
                                                <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                    <li class="p-1"><a href="<?php echo e(route('faqs.edit', ['faq'=> $faq->id])); ?>" class="text-info" data-toggle="tooltip" title="Editar pregunta" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar pregunta" data-id="<?php echo e($faq->id); ?>" data-question="<?php echo e($faq->question); ?>"><i class="far fa-trash-alt"></i></a></li>
                                                </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div id="footer">
                                    <?php echo e($faqs->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <!-- end -->
            
            </div>
        </div>
        <!-- End Main -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('faqs.partials._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('js'); ?>
<script>
$(document).ready(function() {
    $('#search-faq').on('keyup', function() {
        $.ajax({
            type: 'get',
            data: {'search': $(this).val()},
            url: '<?php echo e(route("faqs.manage")); ?>',
            success:function(data) {
                $('#faqs-table > tbody').empty();

                $.each(data.data, function( index, value ) {

                    let category = value.category !== null ? '<a href="#" class="badge badge-info text-white">' + value.category.name + '</a>' : '<a href="#" class="badge badge-secondary">No definido</a>';

                    let editRoute = "<?php echo route('faqs.edit', ':id'); ?>"
                    editRoute = editRoute.replace(':id', value.id);

                    let tr = $('<tr class="candidates-list">'+
                        '<td class="col-2"><p>'+ value.question +'</p></td>'+
                        '<td class="col-6"><p>'+ value.answer +'</p></td>'+
                        '<td class="text-center">'+ category +'</td>'+
                        '<td class="text-center">' + value.created_at + '</td>'+
                        '<td><ul class="list-unstyled mb-0 d-flex justify-content-end">'+
                            '<li class="p-1"><a href="'+ editRoute +'" class="text-info" data-toggle="tooltip" title="Editar pregunta" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>'+
                            '<li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar pregunta" data-id="'+ value.id +'" data-question="'+ value.question +'"><i class="far fa-trash-alt"></i></a></li>'+
                        '</ul></td></tr>');

                    $('#faqs-table > tbody').append(tr);                       
                });
            }
        });
    });
});



$(document).on('click', '.btn-delete', function(e) {
    let button = $(this);
    let modal = $('#deleteFaqs');

    let id = button.data('id');
    let question = button.data('question');

    let message = "Esta seguro que desea eliminar la pregunta `" + question + "`?";

    let route = '<?php echo e(route("faqs.destroy", ":id")); ?>';
    route = route.replace(':id', id);

    modal.find('form').attr('action', route);

    modal.find('#title-delete').text(message);

    modal.modal('show');
});

</script>

<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/faqs/manage.blade.php ENDPATH**/ ?>