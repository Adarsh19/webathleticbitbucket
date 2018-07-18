@extends('layouts.app')
@section('title', 'Home')


@section('content')


    {!! isset($home_page->page_content) ? $home_page->page_content : '' !!}



@endsection


@section('script')
<script>
        $('#newsletterForm').on('submit', function(e) {
            e.preventDefault(); 
            $.ajax({
                type: "GET",
                url: 'subscribe',
                data: $(this).serialize(),
                 success: function( msg ) {
                     $("#form_message").html("<div>"+msg+"</div>");
                 }
            });
        });
    </script>
@endsection

