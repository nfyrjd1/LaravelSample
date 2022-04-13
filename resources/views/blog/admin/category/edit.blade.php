@extends('layouts.app')

@section('content')
<form action="{{ route('blog.admin.category.update', $item->id) }}" method="POST" >
    @method('PATCH')
    @csrf
    <div class="container">
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