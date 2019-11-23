@extends('layouts.template')
@section('kat','active');
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">
                        Kategori
                    <a id="navbar" class="btn btn-primary btn-sm float-right" href="{{route('admin.kategori.create')}}">Tambah Data</a>
                    </div>

                <table class="table">
                        <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th >Nama</th>
                          <th   >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                             @foreach ($kategori as $k)

                      <tr>
                        <td>{{$k->id}}</td>
                        <td>{{$k->nama}}</td>
                        <td>
                        @can('edit-users')
                        <a href="{{route('admin.kategori.edit',$k->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                        @endcan

                        @can('delete-users')
                        <form action="{{route('admin.kategori.destroy',$k)}}" class="float-left" method="POST">
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
