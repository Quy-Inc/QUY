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
            <h4>ID VENUES # {{$getVenues->id_venues}} / <strong>ID MERCHANT # {{$getVenues->merchants->id_merchant}}</strong></h4>
        </div>
		<div class="list-group col-md-4">
            <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Venues Name</strong></h4>
                    <p class="list-group-item-text">{{$getVenues->venues_name}}</p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Caption</strong></h4>
                    <p class="list-group-item-text">{{$getVenues->caption}}</p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Address</strong></h4>
                    <p class="list-group-item-text">
                        {{$getVenues->address['street']}},
                        {{$getVenues->address['district']}},
                        {{$getVenues->address['city']}},
                        {{$getVenues->address['province']}},
                        {{$getVenues->address['country']}},
                        {{$getVenues->address['postal']}}
                    </p>
            </a>
             <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading"><strong>Contact</strong></h4>
                    <p class="list-group-item-text">
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-envelope-o'></i></span>{{$getVenues->contacts['email']}}
                        <br/>
                        <br/>
                        <span style="margin-right:10px; display:inline-block;"><i class='fa fa-phone'></i></span>{{$getVenues->contacts['phone']}}
                    </p>
            </a>
            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Stores</strong>Total : {{$getVenues->storesList->count()}}</h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="{{url('stores')}}/venues/{{$getVenues->merchants->_id}}-{{$getVenues->_id}}"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="{{url('stores')}}/addstores/{{$getVenues->merchants->_id}}-{{$getVenues->_id}}"><i class='fa fa-plus'></i></a>
            </span>
            <span href="#" class="list-group-item">
                    <h4 class="list-group-item-heading"><strong>Tables</strong>Total : {{$getVenues->tablesList->count()}}</h4>
                    <a class='btn btn-warning listtables_ ajax-load' href="{{url('tables')}}/tablelists/{{$getVenues->merchants->_id}}-{{$getVenues->_id}}"><i class='fa fa-list'></i></a>
                    <a class='btn btn-theme-inverse addtables_ ajax-load' href="{{url('tables')}}/addtables/{{$getVenues->merchants->_id}}-{{$getVenues->_id}}"><i class='fa fa-plus'></i></a>
            </span>
        </div>
        <div class='list-group col-md-8'>
        <iframe class='frameGmap' src = "https://maps.google.com/maps?q={{$getVenues->address['coordinate']}}&hl=es;z=14&amp;output=embed"></iframe>
        </div>
        <div class='list-group col-md-8'>
            <div class="fotorama" data-width="100%" data-height="300px" data-fit='cover'>
                @foreach ($getVenues->photos as $photo )
                    <img src="{{url('public/merchant')}}/{{$photo['photo']}}" data-caption="{{$photo['label']}}" data-fit="cover">
                @endforeach
                
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