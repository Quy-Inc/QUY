<?
$id = request('data');
$data = new Modules\stores\models\Stores;
$getStores = $data::find($id);
?>
<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
<div id="content" style="padding-top: 0px;">
	<div class="row">
        <div class="list-group col-md-12">
            <h4>ID STORES # {{$getStores->id_store}} / ID VENUES # {{$getStores->venues->id_venues}} / <strong>ID MERCHANT # {{$getStores->merchants->id_merchant}}</strong></h4>
        </div>
		<div class="list-group col-md-4">
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Store Name</strong></h4>
                    <p class="list-group-item-text">{{$getStores->store_name}}</p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Caption</strong></h4>
                    <p class="list-group-item-text">{{$getStores->caption}}</p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Contact</strong></h4>
                    <p class="list-group-item-text">
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-envelope-o'></i></span>{{$getStores->contacts['email']}}
                        <br/>
                        <br/>
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-phone'></i></span>{{$getStores->contacts['phone']}}
                    </p>
            </a>

            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Menus</strong>Total : {{$getStores->menusList->count()}}</h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="{{url('menusstores')}}/menusstoreslists/{{$getStores->merchants->_id}}-{{$getStores->_id}}"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="{{url('menusstores')}}/addmenusstores/{{$getStores->merchants->_id}}-{{$getStores->_id}}"><i class='fa fa-plus'></i></a>
            </span>
            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Kitchens</strong>Total : {{$getStores->kitchensList->count()}}</h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="{{url('kitchenstores')}}/kitchenstoreslists/{{$getStores->merchants->_id}}-{{$getStores->_id}}"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="{{url('kitchenstores')}}/addkitchenstores/{{$getStores->merchants->_id}}-{{$getStores->_id}}"><i class='fa fa-plus'></i></a>
            </span>
        </div>
        <div class='list-group col-md-8'>
            <div class="fotorama" data-width="100%" data-height="300px" data-fit='cover'>
                @foreach ($getStores->photos as $photo )
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