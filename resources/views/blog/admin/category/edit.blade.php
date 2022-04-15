@extends('layouts.app')

@section('content')
<form action="{{ route('blog.admin.category.update', $item->id) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{$errors->first()}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md">
                @include('blog.admin.category.includes.edit_main_col')
            </div>

            @if ($item->exists)
            <div class="col-md-4">
                @include('blog.admin.category.includes.edit_additional_col')
            </div>
            @endif
        </div>
    </div>
</form>
@endsection