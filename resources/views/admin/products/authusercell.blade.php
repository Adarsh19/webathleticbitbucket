 {{--@if(empty($user))--}}
        {{--<h2>Please select User</h2>--}}
    {{--@else--}}
        {{--<div class="userid_row" id="userrow_{{$user->id}}"><a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>--}}

            {{--<div class="profile_pic ">--}}
                {{--<input type="hidden" class="userids" id="user-id" value="{{$user->id}}">--}}

                    {{--<img class="img-circle profile_img" src="{{ asset('public/web/avatar/groups/'.$user->avatar)}}" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" alt="profile" />--}}

            {{--</div>--}}
            {{--<div class="profile_info">--}}
                {{--<span>{{ $user->name }}</span>--}}

                {{--<h2>{{ $user->email }}</h2>--}}
            {{--</div>--}}

        {{--</div>--}}

    {{--@endif--}}


 <section class="color-cus-black">

     <div class="card-body">
         <div class="content">
             <ul class="simple-user-list userbar_products_ul">
                 @if(!empty($user))
                 <li  style="cursor: pointer" >
                 <a class="close closebtn" style="color: white"><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>
                     <input type="hidden" class="userids" id="user-id" value="{{$user->id}}">
                     <figure class="image rounded">
                         <img src="{{ asset('site_images/'.$user->avatar)}}" alt="{{$user->name}}"  onerror=this.src="{{ asset('admin_files/img/!sample-user.jpg')}}" class="rounded-circle imagesize_logo">
                     </figure>
                     <span class="title">{{$user->name}}</span>
                     <span class="message truncate">{{$user->email}}</span>
                 </li>
                     @else
                     <li>Please select user</li>
                     @endif
             </ul>
         </div>
     </div>
 </section>
