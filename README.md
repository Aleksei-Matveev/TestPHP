# TestPHP

## Задание 1.

1. Создать модуль, реализующий востановление базы данных из [SQL](https://github.com/Aleksei-Matveev/TestPHP/SQL) копий.

2. Модуль должен заменять, дописывать или пропускать данные, если они есть, заменять структуру таблицы если она создана.

## Задание 2.
  Создать API получения данных из таблицы по страницам как в примере
- http://test.woerr.ru/app/php/table_json.php?page=1&limit=5 - Пример формирования данных в JSON.
- page - номер страницы
- limit - количество строк на странице
- URL API http://localhost/api/get_table_data/page=1&limit=5

##### структура ответа в формате JSON:
```(json)
{
    "status": "Число 1, если ОК, или 0, если ошибка",
    "error": "Описание ошибки, или пустая строка",
    "data": {
        "head" :[],
        "body" [
            [],
            []
        ]
    }
}
```
- head - массив имен столбцов таблицы
- body - массив строк массивов значений таблицы

## Решение 

Из [SQL](https://github.com/Aleksei-Matveev/TestPHP/tree/main/SQL/task2) восстановить базу данных и перейти по URL http://%yourhost%/api/get_table_data/page={номер страницы}&limit={Лимит записей на странице}


## Задание 3.
  Описать все возможные ошибки и исключения, которые могут возникнуть при получении данных во втором задании.

## Решение
Всё реализованно во втором задании


## Задание 4.
  Создать API получения данных фильтрацией по полям.
- способ реализация запросов фильтров на Ваш выбор.

## Решение 
Из [SQL](https://github.com/Aleksei-Matveev/TestPHP/tree/main/SQL/task4) восстановить базу данных и перейти по URL http://%yourhost%/api/pc/filter.php/
и передать в качестве параметров критерии для получения данных и БД. 
### Критерии:
- hdd[from]={число} , hdd[to]={число} - Объем жесткого диска.
- speed[from], speed[to] - Частота процессора. PS. При написании readme, думаю нужно было назвать cpufreq. Ну да ладно
- ram[from], ram[to] - Объём оперативной памяти.
- price[from], price[to] - Цена изделия.

Обязательный параметр только один. 
