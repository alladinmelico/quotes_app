@extends('layouts.master')

@section('content')
{{-- {{dd($errors)}} --}}
    @if (count($errors) > 0)
        <section class="info-box-fail">
            <ul>
                @foreach ($errors->all() as $error)
                    {{$error}}

                @endforeach
            </ul>
        </section>
    @endif

    <form action="{{route('admin.login')}}" method="POST">
        @csrf
        <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <label for="password">Your password</label>
            <input type="password" id="password" name="password" placeholder="Your password">
        </div>
        <button type="submit">Login</button>
    </form>
@endsection
