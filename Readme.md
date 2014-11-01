# Crwl - пакет для работы с api [crwl.ru](http://crwl.ru/)

1. Описание
2. Установка
3. Использование
    - Получение списка объявлений
    - Получение объявления
    - Обработка ошибок
4. Тестирование

## Описание

Пакет **iamsalnikov/crwl** дает простой способ для работы с и без того простым api
сервиса [crwl.ru](http://crwl.ru/).

## Установка

Пакет устанавливается через [Composer](http://getcomposer.org). Установить его можно двумя способами.
С помощью установки пакета через консоль:

```bash
composer require "iamsalnikov/crwl" "dev-master"
```

Либо добавив строчку в файл `composer.json`:

```json
"iamsalnikov/crwl": "dev-master"
```

## Использование

Первым шагом необходимо создать объект класса `iamsalnikov\crwl\Crwl`. Конструктор этого класса принимает
на вход ключ для работы с API.

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;

$crwl = new Crwl("API_KEY");
```

Для работы с объявлениями класс `Crwl` имеет два метода: `ads()` и `ad()`. Эти методы возвращают объекты
запросов к API класса `iamsalnikov\crwl\AdsQuery` и `iamsalnikov\crwl\AdQuery` соответственно. Работу с этими
обектами мы рассмотрим дальше.

### Получение списка объявлений

Как говорилось выше, для того, чтобы получить список объявлений, нужно сначала получить объект запроса
класса `iamsalnikov\crwl\AdsQuery`. Делается это очень просто:

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;

$crwl = new Crwl("API_KEY");
$adsQuery = $crwl->ads();
```

Класс `iamsalnikov\crwl\AdsQuery` имеет следующие методы для фильтрации объявлений:

Метод           | Описание
----------------|-----------------------------------------------
source($src)    | Указываем источник данных. Константы с именами источников находятся в классе `iamsalnikov\crwl\Sources`
region($region) | Указываем регион объявлений. Константы с именами регионов находятся в классе `iamsalnikov\crwl\Regions`
minData($date)  | От какой даты берем объявления. Формат даты - `dd-mm-YYYY`
maxDate($date)  | До какой даты берем объявления. Формат даты - `dd-mm-YYYY`
last($hours)    | Берем объявления за последние `$hours` часов

При фильтрации объявления обязательно нужно указывать только источник данных.

Все эти методы можно соединять в цепочку, т.к. они возвращают тот же объект класса `iamsalnikov\crwl\AdsQuery`:

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;
use \iamsalnikov\crwl\Regions;
use \iamsalnikov\crwl\Sources;

$crwl = new Crwl("API_KEY");
$adsQuery = $crwl->ads();
$adsQuery->region(Regions::MOSCOW)->source(Sources::AUTO_RU);

// Можно сделать это короче
$adsQuery2 = $crwl->ads()->region(Regions::MOSCOW)->source(Sources::AUTO_RU);
```

Для того, чтобы получить список объявлений, нужно вызвать метод `get()`:

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;
use \iamsalnikov\crwl\Regions;
use \iamsalnikov\crwl\Sources;

$crwl = new Crwl("API_KEY");
$adsQuery = $crwl->ads();
$adsQuery->region(Regions::MOSCOW)->source(Sources::AUTO_RU);
$ads = $adsQuery->get();

// Можно сделать это короче
$ads2 = $crwl->ads()->region(Regions::MOSCOW)->source(Sources::AUTO_RU)->get();
```

Метод `get()` возвращает массив с объявлениями.

### Получение объявления

Для того, чтобы получить объявление, нужно сначала получить объект запроса
класса `iamsalnikov\crwl\AdQuery`:

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;

$crwl = new Crwl("API_KEY");
$adQuery = $crwl->ads();
```

Для того, чтобы указать, информацию по какому объявлению нужно получить, воспользуйтесь
методом `url($url)`, который принимает на вход адрес объявления. Данный метод возвращает тот же
объект.

Для того, чтобы получить объявление используйте метод `get()`, который вернет данные по этому объявлению:

```php
<?php

//...

use \iamsalnikov\crwl\Crwl;

$crwl = new Crwl("API_KEY");
$adQuery = $crwl->ad();
$adQuery->url("some_url_here");
$ad = $adQuery->get();

// Можно сделать это короче
$ad2 = $crwl->ad()->url("some_url_here")->get();
```