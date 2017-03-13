@extends('layouts.app')

@section('content')
<div class="">
  <button id="askButton" onclick="window.location.href='question/create'"
  class="btn btn-success" type="button" name="button"> Ask Question </button>

  <button id="myButton" onclick="window.location.href='question/user'"
  class="btn btn-primary" type="button" name="button"> My Question </button>



</div>

<div id="listQ" class="row">
  <h3>Question
</h3>
<table class="table table-striped">
<tr>
<th>Title</th>
<!-- <th>Discription</th> -->
<th>Price</th>
<th>Post at</th>
</tr>


@foreach($questions as $question)
<tr>
  <td><a href="{{route('question.show',$question->id)}}">{{$question->title}}</a></td>
  <!-- <td>{{$question->discription}}</td> -->
  <td>{{$question->Qcoin}}</td>
  <td>{{$question->created_at}}</td>
  <!-- <td>
<form class = "" action="{{route('question.destroy',$question->id)}}" method="post">
  <input type ="hidden" name="_method" value="delete">
  <input type ="hidden" name="_token" value="{{ csrf_token() }}">
  <a href="{{route('question.edit',$question->id)}}">Edit</a>
  <input type="submit" class = "btn btn-danger" onclick="return confirm('sour')" name="name" value="delete">
</form>
  </td> -->
</tr>
@endforeach
</table>
</div>
@stop

<style media="screen">
  #listQ{
    padding: 20px 100px;
  }
  #askButton{
    float: right;
    margin-right: 50px;
    margin-bottom: 10px;
  }
  #myButton{
    float: right;
    margin-right: 10px;
    margin-bottom: 10px;
  }
</style>
