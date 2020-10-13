@if(!request('noheader'))
<ol class="breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a class="ajax-load" href="{!!url('/dashboard')!!}">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		@if($subslug == "0")
		<li>
			<span style="text-transform: capitalize !important;">{!!$name!!}</span>
		</li>
		@else
			<li>
				<a class="ajax-load" href="{!!url("/$content->module_slug")!!}">{!!$name!!}</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span style="text-transform: capitalize !important;">{!!$content->sub_menu->$subslug->name!!}</span>
			</li>			
		@endif
	</ol>
@endif
@if($subslug == "0")
	@if(View::exists("$slug.view.home"))
			@include("$slug.view.home")
	@else
		@include("notfound")
	@endif
@else
	@if(View::exists("$slug.view.$subslug"))
			@include("$slug.view.$subslug")
	@else
		@include("$slug.notfound")
	@endif
@endif
