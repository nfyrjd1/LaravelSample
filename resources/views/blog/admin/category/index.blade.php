@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <b>Список категорий</b>
                    <a class="btn btn-sm btn-success" href="{{ route('blog.admin.category.create') }}"
                        role="button">Добавить</a>
                </div>

                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Родитель</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($paginator as $item)
                            @php /* @var \App\Models\BlogCategory $item */ @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route('blog.admin.category.edit', $item->id) }}">{{ $item->title }}</a>
                                </td>
                                <!-- Корневые категории -->
                                <td class="{{ in_array($item->parent_id, [0, 1]) ? 'text-muted' : '' }}">
                                    <!-- TODO вывести тайтл -->
                                    {{ $item->parent_id }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($paginator->total() > $paginator->count())
                <div class="card-footer pb-0">
                    {{ $paginator->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection