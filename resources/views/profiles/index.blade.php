@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="app">
        <div class="col-3 p-5" >
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center" >
                    <div class="h4">{{$user->username}}</div>
                    <div style="visibility: hidden" id="testDiv">{{$user->id}}</div>
                    <div style="visibility: hidden" id="followDiv">{{$follows}}</div>
                        @auth
                    <button class="btn btn-primary ml-4" id="followButton"    v-text="buttonText" user-id="{{$user->id}}"> Follow now</button>
                        @endauth
                    <script type="text/javascript">

                        $(document).ready(function () {
                            let followButton = $('#followButton');
                            followButton.on('click', function () {
                                followUser();
                                if (followButton.text()==="Follow") {followButton.text("Unfollow");}
                                else {followButton.text("Follow"); }

                                alert('button is work');


                            });

                        });


                        function followUser() {

                            let url = '/follow/' + $('#testDiv').text();
                            axios.post(url)
                                .then(response =>{
                                    console.log(response.data)})

                        }
                        ;

                    </script>
                </div>

                @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                    @endcan

            </div>

            @can('update', $user->profile)
                <a  href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-3"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div class="pr-3"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                <div class="pr-3"><strong>{{$user->following->count()}}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#" style="color: #171a1d">{{$user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
