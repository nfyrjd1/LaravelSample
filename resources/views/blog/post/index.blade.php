<h2>Список постов</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Заголовок</th>
            <th>Дата создания</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>