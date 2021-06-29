@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <br>
            <br>
            <br>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Surat Baru</a>
                <a class="btn btn-success" href="/cetak-laporan"> Cetak Laporan</a>
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nomer Surat</th>
            <th>Judul Surat</th>
            <th>Tanggal</th>
            <th>Foto Surat</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $surat)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $surat->nomer }}</td>
            <td>{{ $surat->judul }}</td>
            <td>{{ $surat->tanggal }}</td>
            <td>{{ $surat->foto }}</td>
            <td>
                <form action="{{ route('products.destroy',$surat->id) }}" method="POST">
   
                    <a class="btn btn-success" href="{{ route('products.show',$surat->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$surat->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection