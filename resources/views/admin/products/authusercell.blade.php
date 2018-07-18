


 <section class="color-cus-black">

     <div class="card-body">
         <div class="content">
             <ul class="simple-user-list userbar_products_ul">
                 @if(!empty($user))
                 <li  style="cursor: pointer" id="userrow_{{$user->id}}">
                 <a class="close closebtn" ><span aria-hidden="true" onclick="removeUser(this)">&times; </span></a>
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
