@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form method="post" action="{{url('/store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author</label>
                                <input type="text" class="form-control" id="author" name="author"  placeholder="Enter author">
                            </div>
                            <div class="form-group">
                                <label for="">Publication Date</label>
                                <input type="text" class="form-control" id="publication-date" name="publication-date" placeholder="mm/dd/yyyy">
                            </div>
                            <div class="form-group">
                                <label for="image-upload">Example file input</label>
                                <input type="file" class="form-control-file" id="image-upload" name="image-upload">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>


@endsection