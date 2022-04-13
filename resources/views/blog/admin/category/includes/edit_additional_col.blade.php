<div class="card mb-3">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">id: {{$item->id}}</li>
    </ul>
</div>

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="created_at">Создано:</label>
            <input type="text" value="{{$item->created_at}}" id="created_at" class="form-control" disabled>
        </div>

        <div class="form-group">
            <label for="updated_at">Изменено:</label>
            <input type="text" value="{{$item->updated_at}}" id="updated_at" class="form-control" disabled>
        </div>

        <div class="form-group">
            <label for="deleted_at">Удалено:</label>
            <input type="text" value="{{$item->deleted_at}}" id="deleted_at" class="form-control" disabled>
        </div>
    </div>
</div>