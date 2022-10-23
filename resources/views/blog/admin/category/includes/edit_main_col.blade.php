<div class="card mb-3">
    <div class="card-body">
        <div class="form-group">
            <label for="title">Название:</label>
            <!-- В случае ошибки при сохранении, произойдёт редирект обратно на форму, с затиранием введённых данных -->
            <!-- Чтобы не затирать, с контроллера возвращаем переданные данные обратно -->
            <!-- И тут определяем, что если пришли старые данные, то показываем их, иначе берём из базы -->
            <input name="title" class="form-control" id="title" type="text" required
                value="{{old('title', $item->title)}}">
        </div>

        <div class="form-group">
            <label for="slug">Идентификатор:</label>
            <input name="slug" class="form-control" id="slug" type="text" value="{{old('slug', $item->slug)}}">
        </div>

        <div class="form-group">
            <label for="parent_id">Родитель:</label>
            <select name="parent_id" class="form-control" id="parent_id" placeholder="Выберите категорию" required>
                @foreach($categoryList as $categoryOption)
                <option value="{{$categoryOption->id}}" @if ($categoryOption->id == old('parent_id', $item->parent_id))
                    selected @endif
                    >{{$categoryOption->id}}. {{$categoryOption->title}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-danger" type="button">Удалить</button>
            <button class="btn btn-sm btn-success" type="submit">Сохранить</button>
        </div>
    </div>
</div>