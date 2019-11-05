@if($errors->any())
<div class="field mt-6">

    @foreach ($errors->all() as $error)
    <li class="text-sm text-red-800">{{ $error }}</li>
    @endforeach

</div>
@endif
