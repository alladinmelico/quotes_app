<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Author;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\Models\QuoteLog;

class QuoteController extends Controller
{

    public function getIndex($author=null)
    {
        if(!is_null($author)){
            $quote_author = Author::where('name',$author)->first();
            if($quote_author){
                $quotes = $quote_author->quotes()->orderBy('created_at','desc')->paginate(6);
                // dd($quotes);
            }
        }else{
            $quotes = Quote::orderBy('created_at','desc')->paginate(6);
            // dd($quotes);
        }
        // dd($quotes);
        return view('index',compact('quotes'));
    }

    public function postQuote(Request $request)
    {
        $this->validate($request,[
            'author' => 'required|max:60|alpha',
            'quote' => 'required|max:500',
            'email' => 'required|email'
            ]);

        $authorText = ucfirst($request['author']);
        $quoteText =  $request['quote'];
        $author = Author::where('name',$authorText)->first();
        if(!$author){
            $author= new Author();
            $author->name = $authorText;
            $author->email = $request['email'];
            $author->save();
        }
        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);

        event(new QuoteCreated($author));
        // Event::fire(new QuoteCreated($author));

        return redirect()->route('index')->with([
            'success' => 'Quote Saved !'
            ]);
    }

    public function deleteQuote($quote_id)
    {
        $quote = Quote::find($quote_id);
        $author_deleted = false;
        if(count($quote->author->quotes) === 1){
            $quote->author->delete();
            $author_deleted = true;
        }
        $quote->delete();
        $msg = $author_deleted ? 'Quote and author deleted' : 'Quote deleted ';
        return redirect()->route('index')->with(['success'=> $msg]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
