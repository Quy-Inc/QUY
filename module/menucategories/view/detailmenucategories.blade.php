<?
$id = request('data');
$data = new Modules\menucategories\models\Menucategories;
$Categories = $data::find($id);
?>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<div id="content" style="padding-top: 0px;">
	<div class="row">
        <div class="list-group col-md-12">
            <h4>ID CATEGORY # {{$Categories->id_category}} / <strong>ID MERCHANT # {{$Categories->merchants->id_merchant}}</strong></h4>
        </div>
		<div class="list-group col-md-4">
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Category Name</strong></h4>
                    <p class="list-group-item-text">{{$Categories->category_name}}</p>
            </a>
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Caption</strong></h4>
                    <p class="list-group-item-text">{{$Categories->caption}}</p>
            </a>
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Description</strong></h4>
                    <p class="list-group-item-text">{{$Categories->description}}</p>
            </a>
        </div>
        <div class='list-group col-md-8'>
            <div class="fotorama" data-width="100%" data-height="300px" data-fit='cover'>
                @foreach ($Categories->photos as $photo )
                    <img src="{{url('public/merchant')}}/{{$photo['photo']}}" data-caption="{{$photo['label']}}" data-fit="cover">
                @endforeach
                
            </div>
        </div>
    </div>
</div>
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