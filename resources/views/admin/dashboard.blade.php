@extends('layouts.master')

@section('content')
 <ul>
     @foreach ($authors as $author)
        <li>{{$author->name}}</li>
        <li>{{$author->email}}</li>
     @endforeach
 </ul>
@endsection
