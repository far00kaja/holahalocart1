@extends('layouts.app')

@section('content')
<div class="container">

  <div class="album py-5 bg-light">
        <div class="container">
                <div class="row justify-content-center">
                    <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <form method="POST" action="{{route('filter')}}">
                                        @csrf
                                        @foreach ($kategoris as $kategori)
                                        <input type="checkbox" name="kategori[]" value="{{$kategori->id}}">&nbsp;
                                        <label>{{$kategori->nama}}</label>

                                @endforeach
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </form>
                        </div>
                        </div>
                        </div>
                    </div>

          <div class="row">
              @if (!empty($filter))

@php $filtering= new SplFixedArray(count($filter)); $hitung=0; @endphp
@foreach ($filter as $f)
  @php $filtering[$hitung]=$f->produk_id;
  $hitung++;
  @endphp
@endforeach
              @forelse ($produk->whereIn('id',$filtering) as $p)

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">{{$p->nama}}
                  <div style="height:255px;">
               <img class="img-fluid" src="{{asset('images/'.$p->foto)}}" height="100%" width="100%"></div>
                <div class="card-body">
                  <p class="card-text">{{$p->deskripsi}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    </div>
                    <small class="text-muted">{{implode(', ',$p->tags()->get()->pluck('nama')->toArray())}}</small>
                  </div>
                </div>
              </div>
            </div>
            @empty

            @endforelse
            @else
           @foreach($produk as $p)
            <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">{{$p->nama}}
                        <div style="height:255px;">
                     <img class="img-fluid" src="{{asset('images/'.$p->foto)}}" height="100%" width="100%"></div>
                      <div class="card-body">
                        <p class="card-text">{{$p->deskripsi}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                          </div>
                          <small class="text-muted">{{implode(', ',$p->tags()->get()->pluck('nama')->toArray())}}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
            @endif


    </div>
        </div>

</div>
@endsection
