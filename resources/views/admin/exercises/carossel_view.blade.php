<div class="modal-content" style="background: none;border:none;" >
    <link rel="stylesheet" type="text/css" href="{{ asset('exercises/wowslider.css') }}" />
    <!-- End WOWSlider.com HEAD section -->

    {{--<div class="modal-header">--}}
        {{--<h5 class="modal-title">Exercises for Modal</h5>--}}
        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    {{--</div>--}}
    <div class="modal-body">
        <div id="wowslider-container1">
            <div class="ws_images"><ul>
                    @foreach($predefined_schema as $key=>$predefined_schema_inner)
                        @if(isset($predefined_schema_inner->imagepath))
                    <li>
                        <img src="{{ asset('admin/images/groups/exercises/'.$predefined_schema_inner->imagepath)}}" alt="{{$predefined_schema_inner->imagepath}}" title="{{$predefined_schema_inner->name}}" id="wows1_0"/>Sets: {{$predefined_schema_inner->sets}} Reps: {{$predefined_schema_inner->reps}} Rust: {{$predefined_schema_inner->rust}}</li>
                    @endif
                   @endforeach
                </ul></div>
            <div class="ws_thumbs">
                <div>
                    @foreach($predefined_schema as $key=>$predefined_schema_inner)
                        @if(isset($predefined_schema_inner->imagepath))
                    <a href="#" title="{{$predefined_schema_inner->imagepath}}"><img src="{{ asset('admin/images/groups/exercises/'.$predefined_schema_inner->imagepath) }}" alt="" /></a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="ws_shadow"></div>
        </div>
        <script type="text/javascript" src="{{ asset('exercises//wowslider.js')}}"></script>
        <script type="text/javascript" src="{{ asset('exercises/script.js')}}"></script>
        <!-- End WOWSlider.com BODY section -->
    </div>
</div>

