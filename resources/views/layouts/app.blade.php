<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AES') }}</title>

    <link rel="dns-prefetch"  href="https:fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/ckfinder/ckfinder.js"></script>
   
    <script>
        CKEDITOR.replace( 'article-ckeditor',
        {
            filebrowserBrowseUrl: '/vendor/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            // filebrowserBrowseUrl: '/vendor/unisharp/ckfinder/ckfinder.js',
            //filebrowserUploadUrl: '/vendor/unisharp/ckfinder/ckfinder.js'
        } );
    </script>
<!--
<script>
if ( typeof CKEDITOR !== 'undefined' ) {
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.addCss( 'img {max-width:100%; height: auto;}' );
        var editor = CKEDITOR.replace( 'article-ckeditor', {
            extraPlugins: 'uploadimage,image2',
            removePlugins: 'image',
            height:250
        } );
        CKFinder.setupCKEditor( editor );
    } else {
        document.getElementById( 'article-ckeditor' ).innerHTML =
            '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 4 from CDN.</div>'
    }

    if ( typeof ClassicEditor !== 'undefined' ) {
        ClassicEditor
            .create( document.querySelector( '#article-ckeditor' ), {
                ckfinder: {
                    // To avoid issues, set it to an absolute path that does not start with dots, e.g. '/ckfinder/core/php/(...)'
                    uploadUrl: '/vendor/unisharp/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                }
            } )
            .then( function( editor ) {
                // console.log( editor );
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    } else {
        document.getElementById( 'article-ckeditor' ).innerHTML =
            '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor 5 from CDN.</div>'
    }
</script>
   -->
    </script>

    
</body>
</html>