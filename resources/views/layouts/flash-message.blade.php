@if ($message = Session::get('success'))
<div class="alert alert-success alert-block myshadowcontainer">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong style="text-align: center">{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block myshadowcontainer">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong style="text-align: center">{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block myshadowcontainer">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong style="text-align: center">{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block myshadowcontainer">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong style="text-align: center">{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger myshadowcontainer">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Formoje rasta klaidų
</div>
@endif