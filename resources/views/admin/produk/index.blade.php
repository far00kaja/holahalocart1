@extends('layouts.template')
@section('produk','active');
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">
                        Produk
                    <a id="navbar" class="btn btn-primary btn-sm float-right" href="{{route('admin.produk.create')}}">Tambah Data</a>
                    </div>

                <table class="table">
                        <thead>
                        <tr align="center">
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Foto</th>
                          <th scope="col">Deskripsi</th>
                          <th scope="col">Handled By</th>
                          <th scope="col">Kategori</th>
                          <th scope="col" colspan="2" >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                             @foreach ($produk as $p)

                      <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->nama}}</td>
                        <td align="center"><img class="img-fluid" src="{{asset('images'.'/'.$p->foto)}}" height="50%" width="50%"></td>
                        <td>{{ Str::limit($p->deskripsi, 100) }}</td>
                        <td>{{$p->user->name}}{{--implode(', ',$p->tags()->get()->pluck('name')->toArray())--}}</td>
                        <td>{{implode(', ',$p->tags()->get()->pluck('nama')->toArray())}}</td>

                        <td>
                        @can('edit-users')
                        <a href="{{route('admin.produk.edit',$p->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                        @endcan
                        </td>
                            <td>
                        @can('delete-users')
                        <form action="{{route('admin.produk.destroy',$p)}}" class="float-left" method="POST">
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
