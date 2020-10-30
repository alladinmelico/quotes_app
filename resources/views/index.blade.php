@extends('layouts.master')

@section('title')
Trending Quotes
@endsection

@section('styles')
<link href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
@endsection

@section('content')

@if( !empty(Request::segment(1)))
<section class="filter-bar">
    A filter has been set !
    <a href="{{ route('index') }}"> Show all quotes</a>
</section>
@endif

@if(count($errors) > 0)
<section class="info-box fail">
    <ul>
        @foreach($errors->all() as $error)
        {{ $error }}
        @endforeach
    </ul>
</section>
@endif

@if( Session::has('success') )
<section class="info-box success">
    {{ Session::get('success')}}
</section>
@endif

<section class="quotes">
    <h1> Latest Quotes </h1>
    @for($i=0; $i<count($quotes);$i++)
    <article class="quote">
        <div class="delete">
            <a href="{{ route('delete', ['quote_id' => $quotes[$i]->id ] ) }}">x</a>
        </div>
        {{ $quotes[$i]->quote }}
        <div class="info">
            Created by <a href="{{ route('index',['author' => $quotes[$i]->author->name]) }}"> {{ $quotes[$i]->author->name }} </a> on {{$quotes[$i]->author->created_at}}
        </div>
    </article>
    @endfor
    <div class="pagination container">
        {{ $quotes->links('pagination::bootstrap-4') }}
    </div>
</section>

<section class="edit-quote">

    <h1> Add a Quote</h1>

    <form method="post" action="{{ route('create') }}" >
        <div class="form-group">
            <label for="author">Your name</label>
            <input type="text" name="author" id="author" placeholder="Your name" > </input>
        </div>
        <div class="form-group">
            <label for="quote">Quote</label>
            <textarea name="quote" id="quote" placeholder="Your quote" class="border-2"> </textarea>
        </div>
        <div class="form-group">
            <label for="email">Your email</label>
            <input type="text" name="email" id="email" placeholder="Your email" class="border-2"> </input>
        </div>
        <button type="submit" class="btn">Submit Quote</button>
        <input type="hidden" name="_token" value = "{{ Session::token() }}">
    </form>

</section>
@endsection
