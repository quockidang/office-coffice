@extends('layouts.admin')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Store</a></li>
        <li class="breadcrumb-item active" aria-current="page">List Store</li>
    </ol>
</nav>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stores as $item)
        <tr>
        <th scope="row">{{$item->name}}</th>
        <td scope="row">{{$item->store_code}}</td>
        <td>{{$item->address}}</td>
            <td>No Acction</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('script')

@endsection
