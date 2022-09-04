Полезные пакеты
Пакет для дебага laravel-debugbar (https://github.com/barryvdh/laravel-debugbar)
composer require barryvdh/laravel-debugbar --dev

Пакет для подсказок кода laravel-ide-helper (https://github.com/barryvdh/laravel-ide-helper)
composer require --dev barryvdh/laravel-ide-helper
В composer.json нужно дописать команду для пересчёта кэша:
"scripts": {
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "@php artisan ide-helper:generate",
        "@php artisan ide-helper:meta"
    ]
}
Теперь можно использовать
php artisan ide-helper:generate



Работа с базой (https://laravel.su/docs/5.4/database)
По дефолту ларавель использует utf8mb4 кодировку. utf8mb4_unicode_ci

Миграции - для создания/изменения структуры таблиц
Фабрики - для генерации тестовых данных
Сиды - для вставки тестовых данных в таблицы. Данные либо вручную прописанные в сиде или сгенеренные фабрикой


Миграции (https://laravel.su/docs/5.4/migrations)
Делаем миграцию
php artisan make:migration test_table
Если дописать --table=users, то добавиться код на создание таблицы
Делаем миграцию сразу с созданием модели
php artisan make:model Models/TestModel -m

Запуск миграции
php artisan migrate
Откат миграции
php artisan migrate:rollback --step=1 (количество миграций на сколько откат)
Откат всех миграций
php artisan migrate:reset 
Перезапуск всех миграций (можно добавить step)
php artisan migrate:refresh 

Структура миграции (самые неочевидные)
->increments('id') Для айдишника
->timestamps() Добавляет столбцы created_at, updated_at
->softDeletes() Добавляет deleted_at
->unsigned() Больше нуля
->comment('') Добавляет комментарий в столбец
->index('column') Создание индекса на поле
Создание связи между таблицами
->foreign('id_test')->references('id')->on('test')


Фабрики (https://laravel.su/docs/5.4/seeding)
Создание фабрики
php artisan make:factory TestFactory --model=TestModel
Фабрика создаётся для конкретной модели. Мы прописываем, что для такого-то класса, должны вот так генерироваться данные
После создания фабрики, можем добавить его в DatabaseSeeder
factory(TestFactory::class, 100)->create();


Сиды (https://laravel.su/docs/5.4/seeding)
Создать сид
php artisan:make seeder TestSeeder
Запуск сида
php artisan db:seed --class=TestSeeder
Пересоздание всех миграций и заново заполнение всех данных
php artisan migrate:refresh --seed



Пометки
Ларавельские хелперы https://laravel.su/docs/5.4/helpers

slug - название чего-либо (например категории), но написанное на инглише, чтобы в урл писать такое название, а не айдишник. 
Ларавельный хелпер для создания по строке: str_slug() или Str::slug(), зависит от версии

compact - метод создает массив, содержащий названия переменных и их значения. 
compact($test1, $test2) = ['test1' => $test1, 'test2' => $test2];



Контроллеры (https://laravel.su/docs/5.4/controllers)
Создание контроллера (Флаг ресурс - для добавления всех дефолтных методов)
php artisan make:controller TestController --resourse

Вернуть ошибки на форму
back()->withErrors(['msg' => "test error"])
Вернуть полученные данные обратно на форму, чтобы не стереть их
back()->withInput();



Валидация запросов (https://laravel.su/docs/5.4/validation)
Описываем правила
$rules = [
    'test' => 'string|required|min:5|max:200',
    'id_test' => 'integer|required|exists:test_table,id'
];
Описываем текст ошибок для каждой возможной ситуации
$messages = [
    'test.required' => 'Test required',
    'test.min' => 'Test min 5',
    'test.max' => 'Test max 200',
    'id_test.required' => 'id_test required',
    ...
];
Валидируем
$validatedData = $this->validate($request, $rules, $messages);
$validatedData = $request->validate($rules, $messages);
В случае ошибки, происходит редирект

Также можно самому создать объект валидатора
$validator = Validator::make($request->all(), $rules);
И потом уже доставать что нам нужно
$validator->passes() Прошла проверка или нет (true|false)
$validator->validate() Редирект с ошибками
$validator->valid() Получение валидных данных
$validator->filed() Получение невалидных данных
$validator->errors() Получение ошибок

Создание реквеста
php artisan make:request TestUpdateRequest
На каждый запрос нужно создавать свой класс реквест, где мы и описываем все проверки

В методе rules() возвращаем массив правил как вверху
Также добавляем метод messages(), где возвращаем массив сообщений
После чего идём обратно в контроллер и меняем дефолтный реквест на наш новый
public function update(TestUpdateRequest $request, $id)



Роуты (https://laravel.su/docs/5.4/routing)
Все роуты для страниц хранятся в /routes/web.php
Для апи соответственно в /routes/api.php

Список всех роутов приложения
php artisan route:list

Два способа объявления роута
Route::get('/test', 'TestController@index')->name('test'); Для конкретного метода определяем конкретный метод в контроллере
Route::resource('/test', 'TestController')->names('test'); Для всех методов указываем контроллер, где есть реализации этих методов и пусть ларавель сам определяет кто за что. 
Также можно ограничить список доступных методов
->only(['index', 'create', 'store'])

В роутах можно объявлять сразу группы роутов
Route::group(['namespace' => Префикс для пути до классов контроллеров, 'prefix' => Префикс для пути в урле], function () {
    //Объявление под-роутов
});
Пример без namespace и без prefix
Route::resource('testRoute/test', 'Test/TestController')
Пример c namespace и с prefix
Route::group(['namespace' => 'Test', 'prefix' => 'testRoute'], function () {
    Route::resource('test', 'TestController')
}

Каждому роуту можно дать своё имя
Route::resource('test', 'TestController')->names('test');
Это позволит в будущем проще редиректить на этот роут из другой части приложения
redirect()->route('test')



Модели
Создание модели
php artisan make:model TestModel

Если наша таблица создана с помощью ->softDeletes(), то в моделе мы можем использовать трейт use SoftDeletes;
После этого запрос ::all() будет сразу возвращать данные с условием WHERE deleted_at IS NULL, чтобы возвращать все записи, необходимо писать ::withTrashed()->all()

Для апдейта уже созданного объекта класса мы можем использовать метод $item->fill($data), но для его использования, необходимо указать в моделе список полей сущности, которые доступны для изменения с помощью этого метода
protected $fillable = ['test'];



Вьюшки (Blade-шаблоны)
Вставка ссылки 
href="{{ route('test') }}"
href="{{ url('/test') }}"

Отрисовка в цикле
@foreach ($items as $item)
    <span>{{ $item->name }}</span>
@endforeach

Отрисовка по условию
@if (true)
    <span>test</span>
@endif

Вставка контента в шаблон
В родительском файле указываем место, для вставки контента
@yield('test')
В дочернем элементе указываем в какой файл мы собираемся встраиваться
@extends('layouts.app')
И указываем в какую секцию вставить контент
@section('content')
    <span>test</span>
@endsection

Также можно сразу импортировать нужный шаблон в родителе
@include('test')

Можно в вёрстке указать класс сущности с которой работаем
@php /** @var \App\Models\Test $item */ @endphp
Позволит сразу видеть класс и проваливаться в него через контрол

Для форм указываем метод
@method('PATCH')
Также указываем использование 
@csrf

В случае ошибки при сохранении, произойдёт редирект обратно на форму
Получить ошибки
{{ $errors->first() }}
Также произойдёт затирание введённых данных. Чтобы не затирать, с контроллера мы возвращаем переданные данные обратно и определяем, что если пришли старые данные, то показываем их, иначе берём из базы
{{ old('test', $item->test) }}
Получить сообщение об успешном сохранении
{{ session('success') }}



Аутентификация
Создание дефолтной аутентификация из коробки
php artisan make:auth
php artisan migrate
Роут /register

Теперь можем добавить в контроллер проверку на авторизацию
public function __construct()
{
    $this->middleware('auth');
}
