<?
$id = request('data');
$data = new Modules\venues\models\Venues;
$getVenues = $data::find($id);
?>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<div id="content" style="padding-top: 0px;">
	<div class="row">
        <div class="list-group col-md-12">
            <h4>ID VENUES # <?php echo e($getVenues->id_venues); ?> / <strong>ID MERCHANT # <?php echo e($getVenues->merchants->id_merchant); ?></strong></h4>
        </div>
		<div class="list-group col-md-4">
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Venues Name</strong></h4>
                    <p class="list-group-item-text"><?php echo e($getVenues->venues_name); ?></p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Caption</strong></h4>
                    <p class="list-group-item-text"><?php echo e($getVenues->caption); ?></p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Address</strong></h4>
                    <p class="list-group-item-text">
                        <?php echo e($getVenues->address['street']); ?>,
                        <?php echo e($getVenues->address['district']); ?>,
                        <?php echo e($getVenues->address['city']); ?>,
                        <?php echo e($getVenues->address['province']); ?>,
                        <?php echo e($getVenues->address['country']); ?>,
                        <?php echo e($getVenues->address['postal']); ?>

                    </p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Contact</strong></h4>
                    <p class="list-group-item-text">
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-envelope-o'></i></span><?php echo e($getVenues->contacts['email']); ?>

                        <br/>
                        <br/>
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-phone'></i></span><?php echo e($getVenues->contacts['phone']); ?>

                    </p>
            </a>
            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Stores</strong>Total : <?php echo e($getVenues->storesList->count()); ?></h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="<?php echo e(url('stores')); ?>/venues/<?php echo e($getVenues->merchants->_id); ?>-<?php echo e($getVenues->_id); ?>"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="<?php echo e(url('stores')); ?>/addstores/<?php echo e($getVenues->merchants->_id); ?>-<?php echo e($getVenues->_id); ?>"><i class='fa fa-plus'></i></a>
            </span>
            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Tables</strong>Total : <?php echo e($getVenues->tablesList->count()); ?></h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="<?php echo e(url('tables')); ?>/tablelists/<?php echo e($getVenues->merchants->_id); ?>-<?php echo e($getVenues->_id); ?>"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="<?php echo e(url('tables')); ?>/addtables/<?php echo e($getVenues->merchants->_id); ?>-<?php echo e($getVenues->_id); ?>"><i class='fa fa-plus'></i></a>
            </span>
        </div>
        <div class='list-group col-md-8'>
        <iframe class='frameGmap' src = "https://maps.google.com/maps?q=<?php echo e($getVenues->address['coordinate']); ?>&hl=es;z=14&amp;output=embed"></iframe>
        </div>
        <div class='list-group col-md-8'>
            <div class="fotorama" data-width="100%" data-height="300px" data-fit='cover'>
                <?php $__currentLoopData = $getVenues->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(url('public/merchant')); ?>/<?php echo e($photo['photo']); ?>" data-caption="<?php echo e($photo['label']); ?>" data-fit="cover">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){

        // $(".listtables_").on("click",function(e){
        //     e.preventDefault();
        //     e.stopPropagation();
        //     e.stopImmediatePropagation();
        //     $("#md-full-width").modal('hide');
        // });

    });
</script>
<style>
    .frameGmap{
        border: none;
        width: 100%;
        height: 200px;
    }

    .addtables_
    {
        position: absolute;
        top: 0;
        right: 0;
        margin: 5px;
    }

    .listtables_
    {
        position: absolute;
        top: 0;
        margin: 5px;
        right: 50px;
    }
</style>