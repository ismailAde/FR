@extends('master')

@section('notification')
	<div class="notification">
		FRIEND REQUESTS
		<div class="requests-ntf">
			@foreach($requests as $request)
				@foreach($allUsers as $allUser)
					@if(($allUser->id == $request) && ($allUser->id != $user->id))
						<div class="single-request">
							<span class="request-name">{{ $allUser->name }}</span>
							<span class="decline-request">{{ link_to_route('decline_request_path', 'NO', ['user_id' => $user->id, 'request_id' => $request]) }}</span>
							<span class="accept-request">{{ link_to_route('accept_request_path', 'Yes', ['user_id' => $user->id, 'request_id' => $request]) }}</span>
						</div>
					@endif
				@endforeach
			@endforeach
		</div>
	</div>
@stop



@section('left_content')
	FRIENDS
	@foreach($friends as $friend)
		@foreach($allUsers as $allUser)
			@if(($allUser->id == $friend->friend) && ($allUser->id != $user->id))
				<span class="user-entry">{{ $allUser->name }}
					<span class="remove">
						{{ link_to_route('delete_friend_route', 'X', ['user_id' => $user->id, 'friend_id' => $allUser->id]) }}
					</span>
				</span>
			@endif
		@endforeach
	@endforeach
@stop



@section('name')
	{{ $user->name }}
@stop



@section('right_content')
	ADD NEW FRIENDS
	@foreach($nonFriends as $nonFriend)
		@if($nonFriend->id != 0)
			@foreach($allUsers as $allUser)
				@if($allUser->id == $nonFriend->id)
					<span class="user-entry add-row">{{ link_to_route('create_request_path', $allUser->name, ['user_id' => $user->id, 'reciever_id' => $allUser->id]) }}<span class="add">+</span></span>
				@endif
			@endforeach
		@endif
	@endforeach
@stop
