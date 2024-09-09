@if (Session::has('success'))
<div class="bg-green-300 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
    {{ Session::get('success') }}
</div>                
@endif

@if (Session::has('error'))
<div class="bg-red-300 border-red-600 p-4 mb-3 rounded-sm shadow-sm">
{{ Session::get('error') }}
</div>                
@endif