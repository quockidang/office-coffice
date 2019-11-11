@extends('layouts.admin')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Customers</a></li>
        <li class="breadcrumb-item active" aria-current="page">List Customers</li>
    </ol>
</nav>

<table class="table">
    <thead class="thead-dark">
        <tr>

            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Point</th>
            <th scope="col">Acction</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
        <tr>
        <th scope="row">{{$item->name}}</th>
        <td>{{$item->phone}}</td>
        <td>{{$item->point . ' Point'}}</td>
        <td>None Action</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
