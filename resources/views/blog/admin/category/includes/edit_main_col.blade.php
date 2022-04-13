<div class="card mb-3">
    <div class="card-body">
        <div class="form-group">
            <label for="title">Название:</label>
            <input name="title" class="form-control" id="title" type="text" required value="{{$item->title}}">
        </div>

        <div class="form-group">
            <label for="slug">Идентификатор:</label>
            <input name="slug" class="form-control" id="slug" type="text" value="{{$item->slug}}">
        </div>

        @if ($item->id > 1)
        <div class="form-group">
            <label for="parent_id">Родитель:</label>
            <select name="parent_id" class="form-control" id="parent_id" placeholder="Выберите категорию" required>
                @foreach($categoryList as $categoryOption)
                <option value="{{$categoryOption->id}}" @if ($categoryOption->id == $item->parent_id) selected @endif
                    >{{$categoryOption->id}}. {{$categoryOption->title}}
                </option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea name="description" class="form-control" id="description" rows="3">
                {{$item->description}}
            </textarea>
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-danger" type="button">Удалить</button>
            <button class="btn btn-sm btn-success" type="submit">Сохранить</button>
        </div>
    </div>
</div>