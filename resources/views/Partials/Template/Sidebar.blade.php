{{--{{--}}
{{--dd($categories)--}}
{{--}}--}}
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">David Williams</span>
                        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
            </li>
            @foreach($categories as $key => $category)
                <li>
                    <a href="javascript:void(0)" class="categories" data-id="{{$category->url}}"><i class="{{$category->icon}}"></i> <span class="nav-label">{{$category->name}}</span></a>
                </li>
            @endforeach


        </ul>

    </div>
</nav>
<script>
    $(document).ready(function () {
       $("a.categories").on('click',function () {
           $.ajax({
               url     : $(this).attr('data-id'),
               method  :'GET',
               datatype: "HTML",
               success : function (html) {
                   $("div#layoutContainer").empty().html(html);

               }
           }).fail(function(jqXHR, ajaxOptions, thrownError){
               alert('No response from server');
           });
       });
    });
</script>



