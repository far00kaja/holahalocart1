@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produk</div>

                <table class="table">
                        <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Roles</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                           @foreach ($users as $u)

                      <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->nama}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{implode(', ',$u->roles()->get()->pluck('name')->toArray())}}</td>
                        <td>
                        @can('edit-users')
                        <a href="{{route('admin.users.edit',$u->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                        @endcan
                        @can('delete-users')
                        <form action="{{route('admin.users.destroy',$u)}}" class="float-left" method="POST">
                        @csrf
                        {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-warning">Delete</button>
                        </form>
                        @endcan
                        </td>
                      </tr>

                @endforeach

                    </tbody>
                  </table>
                <div class="card-body">
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
