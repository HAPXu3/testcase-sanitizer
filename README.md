## Требования

PHP 7.4 или выше

## Использование

```
$sanitizer = new App\Sanitizer;

$jsonString = '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}';
$json = json_decode($jsonString, true);
$rules = ['integer', 'string', 'phone'];

$result = $sanitizer->sanitize($json, $rules);
```

По умолчанию доступны следующие правила для валидации и конвертации:  
```array``` - проверка типа одномерный массив  
```float``` - проверка и приведение типа число с плавающей запятой  
```integer``` - проверка и приведение целочисленного типа  
```phone``` - проверка на совпадение паттерна номера телефона  
```string``` - проверка и приведение строковго типа  
```structure``` - проверка типа ассоциативный массив  

Для типов ```array``` и ```structure``` можно настроить обработчики:  
Для ```array```:
```
$config = [
    'array' => [
        'typeRestrict' => 'string',
    ]
];
```
Для ```structure```:
```
$config = [
    'structure' => [
        'fieldsRestrict' => [
            'baz' => 'string',
            'foo' => 'integer',
            'bar' => 'string',
        ]
    ]
];
```
Затем:  
```
$sanitizer = new App\Sanitizer($config);
```

Расширение правил возможно двумя способами:
* Создать объект класса ```App\HandlerFactory```, вызвать метод ```extend``` с именем и классом нового правила и передать объект в конструктор ```App\Sanitizer```
* Вызвать метод ```addRuleHandler``` с именем и классом нового правила у объекта класса ```App\Sanitizer```

При создании нового правила необходимо соблюсти два соглашения:
* Класс обработчика должен реализовать интерфейс ```App\Handlers\Handler```
* Класс возвращаемой ошибки должен наследоваться от абстрактного класса ```App\Errors\Error```

Проверка наличия ошибок:
```
$hasErrors = $sanitizer->hasErrors()
```

Получение списка ошибок:
```
$errors = $sanitizer->getErrors()
```

## Тесты

```
vendor/bin/phpunit tests
```
