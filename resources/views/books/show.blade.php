@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">

                {{--<div class="panel-body">--}}
                    <div class="panel-heading">
                        <h1 align="center">{{ Auth::user()->name }}'s secret book list</h1>
                    </div>
                    @if(isset($books))
                        @foreach($books as $books_chunk)

                        <table class="table">


                            <tbody>
                                <tr>
                                    @foreach($books_chunk as $book)
                                        <td align="right">
                                            <img src=" {{$book['image'] }}" alt="">
                                        </td>
                                        <td align="left">
                                            <p>Author: {{ \Illuminate\Support\Str::title($book['author']) }}</p>
                                            <p>Published in {{ $book['publication'] }}</p>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>


                        </table>
                        @endforeach

                    @endif
                </div>
                    {{--<div class="container">--}}
                        {{--<div class="card">--}}
                            {{--<div class="row">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

@endsection