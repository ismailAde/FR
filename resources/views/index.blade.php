@extends('master')

@section('left_content')
	EXISTING USERS
	@foreach ($users as $user)
		<a href="user/{{ $user->id }}"><span class="user-entry">{{ $user->name }}</span></a>
	@endforeach
@stop

@section('right_content')
	CREATE NEW USER
	{{ Form::open(['route'=>'create_user_path'])}}
		{{ Form::text('name', 'NAME', ['class'=>'inputs']) }}
		{{ Form::text('email', 'E-MAIL', ['class'=>'inputs']) }}
		{{ Form::text('username', 'USERNAME', ['class'=>'inputs']) }}
		{{ Form::submit('SUBMIT', ['class'=>'input input-submit']) }}
	{{ Form::close() }}
@stop