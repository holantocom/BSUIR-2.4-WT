# Лабораторные ВТ
### Лабораторная 1 (HTML + CSS / Browser)
#### Задание:
1. Выбрать тематику сайта.
2. Сделать набросок структуры страниц (расположение заголовка, меню, основной области, боковых блоков, подвала и т.д. см. пример рис.1)
3. Разработать набор веб-страниц (HTML, CSS) выбранной тематики. Наполнить страницу содержимым соответствующим предметной области выбранного сайта. На одной из страниц обязательно должна быть форма. Использовать блочную вёрстку.
4. Каждый набор должен включать не менее пяти страниц разного типа (титульная, новости, поиск, карта сайта, каталог товаров и тому подобное).

### Лабораторная 2 (PHP / Browser)
#### Общее задание:
На экран вывести ссылки меню с названиями (например "О компании", "Услуги", "Прайс", "Контакты"). При клике по ссылке меняется и остается измененным цвет фона вокруг активной ссылки. Весь код на одной странице. Не использовать javascript. Использовать GET-запросы.

#### Задание:
4. Создайте 2 массива с целыми числами через 2 поля формы, объедините два массива в один (не используя специальные функции PHP типа array_merge(arr1,arr2)!), Выведите все чётные числа из получившегося массива.

### Лабораторная 3 (PHP / Browser)
#### Задание:
4. Написать функцию, формирующую полный список файлов в указанном каталоге (включая подкаталоги) и считающую общий объём файлов. Имя каталога, в котором следует выполнять поиск, получать через веб-форму. Отобразить в табличном виде.

#### Расширенные задания:
1. Написать часть системы управления сайтом, отвечающую за добавление, удаление и перемещение файлов. Фактически требуется реализовать примитивный веб-ориентированный файловый менеджер для управления файловой системой на стороне сервера. Использовать добавленный файл, если графический отобразить, текстовый – отобразить первые 30 символов. Дополнительными возможностями такого файлового менеджера может быть управление каталогами, редактирование текстовых файлов, конвертация графических файлов, шифрование и дешифрование файлов, создание и распаковка архивов и тому подобное.

### Лабораторная 4 (PHP / Browser)
#### Задание:
4. В произвольном тексте все целые числа вывести синим цветом, все дроби вывести красным цветом и округлить до десятых, все слова, начинающиеся с большой буквы, вывести зелёным цветом. Текст вводить через форму.

#### Расширенные задания:

Написать шаблонизатор (программу, управляющую сборкой готовых HTML-страниц из отдельных шаблонов). Шаблонизатор должен уметь обрабатывать следующие инструкции:

`{FILE="path_to_file"}` – чтение и подстановка указанного файла;
`{CONFIG="value"}` – чтение и подстановка значения из конфигурационного файла;
`{VAR="variable_name"}` – подстановка значения из массива `$VARS`, формируемого в процессе работы приложения;
`{DB="value"}` – подстановка значения из предопределённой таблицы в БД, хранящей текстовые надписи, настройки приложения и тому подобную информацию;
`{IF "var_1"</>/==/!=/<=/>="var2"} PART1 {ELSE} PART2 {ENDIF}` – анализ условия и удаление из шаблона той части, которая не соответствует условию; условия могут быть вложенными; часть `{ELSE}` может отсутствовать.

