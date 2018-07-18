@if($newsLetter)        
PDF Name: {{ $newsLetter->path }}<br>
Download Link: <a href="{{ asset('newsletter/'.$newsLetter->file_name) }}">Click Here</a>
@endif