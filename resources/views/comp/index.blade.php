@extends('template')

@section('content')

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand"><h2>Crud</h2></a>
        <form class="d-flex">
            <a href="{{route('comp.create')}}" class="btn btn-success" type="submit">Create</a>
        </form>
    </div>
</nav>

<div class="container" style="margin-top: 50px">
    <table class="table table-bordered">
        <tr class="text-center">
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach ($comps as $c)
        <tr class="text-center" style="vertical-align: 10px">
            <th>{{$i++}}</th>
            <td>{{$c->name}}</td>
            <td>Rp. {{number_format($c->price)}}</td>
            <td>
                <img src="{{url('storage/'.$c->image)}}" style="max-width: 100px !important" alt="">
            </td>
            <td>
                <form class="container" action="{{route('comp.destroy',$c->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                <a href="{{route('comp.edit',$c->id)}}" class="btn btn-warning" type="submit">Edit</a>
                <button type="submit" href="{{route('comp.destroy', $c->id)}}" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection
