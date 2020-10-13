<?
$id = request('data');
$data = new Modules\merchants\models\Merchants;
$getMerchants = $data::find($id);
?>
<div id="content" style="padding-top: 0px;">
	<div class="row">
        <div class="list-group col-md-2" style="margin: 0px !important; padding: 0px !important;">
            <div class='col-md-12' style="margin: 0px !important; padding: 0px !important; padding-right: 10px !important;">
                <img src="<?php echo e(url('public/merchant')); ?>/<?php echo e($getMerchants->logo); ?>" class='img-responsive' />
            </div>
           
        </div>
		<div class="list-group col-md-4">
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>ID MERCHANT</strong></h4>
                    <p class="list-group-item-text"><?php echo e($getMerchants->id_merchant); ?></p>
            </a>
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Merchant Name</strong></h4>
                    <p class="list-group-item-text"><?php echo e($getMerchants->merchant_name); ?></p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Caption</strong></h4>
                    <p class="list-group-item-text"><?php echo e($getMerchants->caption); ?></p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Contact</strong></h4>
                    <p class="list-group-item-text">
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-envelope-o'></i></span><?php echo e($getMerchants->contacts['email']); ?>

                        <br/>
                        <br/>
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-phone'></i></span><?php echo e($getMerchants->contacts['phone']); ?>

                    </p>
            </a>
        </div>
        <div class="list-group col-md-6">
            <ul class="bs-glyphicons">
                <li class='bg bg-inverse'> 
                    <a href="<?php echo e(url('venues/merchants/')); ?>/<?php echo e($id); ?>" class='ajax-load linkmenu'>
                        <span class="glyphicon glyphicon-cutlery"></span>
                        <span class="glyphicon-class">Venues</span>
                    </a>
                </li>
                <li class='bg bg-theme-inverse'>
                    <a href="<?php echo e(url('kitchens/kitchenslists/')); ?>/<?php echo e($id); ?>" class='ajax-load linkmenu'>
                        <span class="glyphicon glyphicon-glass"></span>
                        <span class="glyphicon-class">Kitchens</span>
                    </a>
                </li>

                 <li class="bg bg-info">
                    <a href="<?php echo e(url('menucategories/menuscategorieslists/')); ?>/<?php echo e($id); ?>" class='ajax-load linkmenu'>
                        <span class="glyphicon glyphicon-indent-left"></span>
                        <span class="glyphicon-class">Categories</span>
                    </a>
                </li>

                <li class="bg bg-primary">
                    <a href="<?php echo e(url('menus/menulists/')); ?>/<?php echo e($id); ?>" class='ajax-load linkmenu'>
                        <span class="glyphicon glyphicon-list-alt"></span>
                        <span class="glyphicon-class">Menu</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
ul.bs-glyphicons > li 
{
    width: 20% !important;
    height: auto !important;
    margin: 0px 5px !important;
    margin-bottom: 10px !important;
    cursor: pointer;
}

ul.bs-glyphicons > li:hover
{
    opacity:0.9 !important;
}

a.linkmenu{
    color: inherit !important;
}
</style>