@extends('layouts.admin')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Amin</a></li>
        <li class="breadcrumb-item active" aria-current="page">List Account</li>
    </ol>
</nav>

<table class="table">
    <thead class="thead-dark">
        <tr>

            <th scope="col">Name</th>
           
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $item)
        <tr>
        <th scope="row">{{$item->name}}</th>

            <td>
                @if ($item->status == 1)
                    <span class="badge badge-success">Kích hoạt</span>
                @endif
                @if($item->status != 1)
                <span class="badge badge-danger">Khóa</span>
                @endif
            </td>
            <td>abc</td>
        </tr>
        @endforeach


    </tbody>
</table>
@endsection
@section('script')

@endsection
