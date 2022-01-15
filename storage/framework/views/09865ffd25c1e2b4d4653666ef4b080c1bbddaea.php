<?php $__env->startSection('title', 'Categorias de sorteos'); ?>

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
                    <div class="mt-4">
                        <h1 class="ml-3 p-4 d-inline special-title">Gestion de categorias de sorteos</h1>
                        <a class="d-inline btn-create" href="#" title="Crear categoria">
                            <i class="far fa-plus-square fa-2x"></i>
                        </a>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="user-dashboard-info-box mb-3 bg-white p-4 shadow-sm">
                            <div class="col-12">
                                <?php if(!$categories->isEmpty()): ?>
                                    <table class="table table-hover mb-0" id="companies-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Veces usado</th>
                                                <th class="text-center">Creado</th>
                                                <th class="text-center">Ultima modificacion</th>
                                            </tr>
                                        </thead>

                                    
                                        <div class="input-group rounded">
                                            <input type="search" class="form-control border-right-0" id="search-categories" placeholder="Ingresa el nombre de la categoria" aria-label="Search" aria-describedby="search-addon" />
                                            <span class="input-group-text rounded-right border-left-0" id="search-addon" style="border-top-left-radius:0; border-bottom-left-radius:0;">
                                                <i class="fas fa-search"></i>
                                            </span>
                                        </div>

                                        <tbody>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="candidates-list">
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p><?php echo e($category->name); ?></p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p><?php echo e($category->raffles_count); ?></p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p><?php echo e($category->created_at); ?></p>
                                                    </td>
                                                    <td class="candidate-list-favourite-time text-center">
                                                        <p><?php echo e($category->updated_at); ?></p>
                                                    </td>
                                                    <td>
                                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                                        <li class="p-1"><a href="#" class="text-success btn-edit" data-toggle="tooltip" title="Editar categoria" data-id="<?php echo e($category->id); ?>"><i class="fas fa-pencil-alt"></i></a></li>
                                                        <li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar categoria" data-id="<?php echo e($category->id); ?>" data-name="<?php echo e($category->name); ?>"><i class="far fa-trash-alt"></i></a></li>
                                                    </ul>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <h5 class="text-center w-100">No se encontraron registros</h5>
                                <?php endif; ?>

                                <div id="footer">
                                    <?php echo e($categories->links()); ?>

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

<?php echo $__env->make('raffleCategories.partials._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('raffleCategories.partials._update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('raffleCategories.partials._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('js'); ?>
<script>
$(document).ready(function() {
    $('#search-categories').on('keyup', function() {
        $.ajax({
            type: 'get',
            data: {'search': $(this).val()},
            url: '<?php echo e(route("raffleCategories.index")); ?>',
            success:function(data) {

                jQuery.noConflict();
                
                console.log('here');
                $('#companies-table > tbody').empty();

                $.each(data.data, function( index, value ) {

                    let tr = $('<tr class="candidates-list"><td class="candidate-list-favourite-time text-center">' +
                    '<p>' + value.name + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.raffles_count + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.created_at + '</p></td><td class="candidate-list-favourite-time text-center">'+
                    '<p>' + value.updated_at + '</p></td><td>'+
                    '<ul class="list-unstyled mb-0 d-flex justify-content-end">'+
                    '<li class="p-1"><a href="#" class="text-success btn-edit" data-toggle="tooltip" title="Editar categoria" data-id="' + value.id + '"><i class="fas fa-pencil-alt"></i></a></li>'+
                    '<li class="p-1"><a href="#" class="text-danger btn-delete" title="Eliminar categoria" data-id="'+ value.id +'" data-name="'+ value.name +'"><i class="far fa-trash-alt"></i></a></li>'+
                    '</ul></td></tr>');
                    
                    $('#companies-table > tbody').append(tr);
                });
            }
        });
    });
});


/* Manejo de modal de creacion */
$(document).on('click', '.btn-create', function(e) {

jQuery.noConflict();

let button = $(this);
let modal = $('#createCategories');

modal.modal('show');
    
});

/* Manejo de modal de actualizacion */
$(document).on('click', '.btn-edit', function(e) {

    jQuery.noConflict();

    let button = $(this);
    let modal = $('#updateCategories');

    let id = button.data('id');

    $.ajax({
        type: 'get',
        data: {'id': id},
        url: '<?php echo e(route("raffleCategories.getCategory")); ?>',
        success:function(value) {

            let route = '<?php echo e(route("raffleCategories.update", ":id")); ?>';
            route = route.replace(':id', id);

            modal.find('form').attr('action', route);
            modal.find('form #name').val(value.name);

            modal.modal('show');
        }
    });
});

/* Manejo de modal de eliminacion */
$(document).on('click', '.btn-delete', function(e) {

    jQuery.noConflict();

    let button = $(this);
    let modal = $('#deleteCategories');

    let id = button.data('id');
    let name = button.data('name');

    let message = "Esta seguro que desea eliminar la categoria `" + name + "`? Esta acion no se podra deshacer...";

    let route = '<?php echo e(route("raffleCategories.destroy", ":id")); ?>';
    route = route.replace(':id', id);

    modal.find('form').attr('action', route);

    modal.find('#title-delete').text(message);

    modal.modal('show');
});

</script>

<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/raffleCategories/index.blade.php ENDPATH**/ ?>