<meta name="csrf-token" content="{{ csrf_token() }}">
<script>window.Laravel = { csrfToken: '{{csrf_token()}}' }</script>

<div id="app">
    <feeds></feeds>
</div>

<script src="{{asset('js/app.js')}}"></script>