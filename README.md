# QuickAuth

Быстрая авторизация (смена пользователей) в Битрикс без ввода пароля.

Данный компонент использует системный компонент `main.user.selector` ([документация](https://dev.1c-bitrix.ru/api_d7/bitrix/main/systemcomponents/mainuserselector/index.php))

### Использование

Для использования необходимо клонировать данный репозиторй в папку `/local/components`.

Далее на любой странице вызывать компонент:

```php
$APPLICATION->IncludeComponent('ramapriya:quick.auth', '', []);
```

### Примечание

По умолчанию компонент настроен на выбор интранет-пользователей

Если вам нужна возможность выбора любого пользователя, удалите параметр `userSearchArea` в классе компонента (файл `ramapriya/quick.auth/class.php`, метод `getSelectUserComponentParams`)

[Статья на Хабре](https://habr.com/ru/post/508316/)