@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="panel-heading">
            <h4>Welcome home, {{ Auth::user()->name }} </h4>
        </div>
        @if(isset($books))
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div align="center" class="panel-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-6">
                                <form method="post" action="{{url('/sort') }}" class="form-inline">
                                    {{ csrf_field() }}
                                    <div class="form-group mx-sm-3">
                                        <label for="sort" ></label>
                                        <input type="text" class="form-control" id="sort" name="sort" placeholder="Sort by">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div align="right" class="col-sm-6">
                                <a class="btn btn-primary" href="{{url('/create')}}" role="button">Add Book</a>
                            </div>
                        </div>
                    </div>
                        <table class="table">
                        @foreach($books as $books_chunk)
                            <tbody>
                            <tr>
                                @foreach($books_chunk as $book)
                                    <td align="center">
                                        <img src=" {{$book['image'] }}" alt="">
                                    </td>
                                    <td align="left">
                                        <div class="row">
                                            <p>Author: {{ $book['author'] }}</p>
                                            <p>Published in {{ $book['publication'] }}</p>
                                        </div>
                                        <div class="row">
                                            <form method="post" action="{{url('/edit_order') }}" class="form-inline">
                                                {{ csrf_field() }}
                                                @if(isset($total))
                                                <div class="form-group">
                                                    <label for="order">Set Order</label>
                                                    <select class="form-control" id="order" name="order">
                                                        @foreach($total as $number)
                                                            <option>{{$number}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="title" value="{{$book['title']}}">
                                                    <input type="hidden" name="author" value="{{$book['author']}}">
                                                    <input type="hidden" name="book_id" value="{{$book['id']}}">
                                                    <button type="submit" class="btn btn-primary" >Submit</button>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                        <p></p>
                                        <div class="row">
                                            <form method="post" action="{{url('/delete')}}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" value="{{$book['user_id']}}">
                                                    <input type="hidden" name="title" value="{{$book['title']}}">
                                                    <input type="hidden" name="author" value="{{$book['author']}}">
                                                    <input type="hidden" name="book_id" value="{{$book['id']}}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
