Veeam test task
=======================

Introduction
------------
Implement the interface to view the list of jobs with the ability to filter by language and departments. Each job is
defined by the following properties: a department, job title and description. The department is a separate object
defined by identifier and name. At the same job title and its description can be translated into several languages ​
​(ru, fr, it, ...).


Requirements
------------

The interface must contain a filter by department, and language, as well as a list of suitable vacancies. If there is
no translation in the selected language, the open position is displayed in the default language (en).

To implement use Zend Framework 2.x, Doctrine 2 and Composer. The result must be put on Github.com.

Additional
----------

 - Zend Coding Style
 - Valid docbocks with comments in English
 - More than one commit in the history of Github
 - Unit tests


Тестовое задание от Veeam software
==================================

Описание
--------

Реализовать интерфейс просмотра списка вакансий с возможностью фильтра по отделам и языку. Каждая вакансия определена
следующими свойствами: отдел, название вакансии и ее описание. Отдел является отдельным объектом, представлен
идентификатором и названием. При этом название вакансии и её описание могут быть переведены на несколько языков
(ru, fr, it, ...).

Требования
----------

Интерфейс должен содержать фильтр по отделу и языку, а также список подходящих вакансий. Если нет перевода на выбранный
язык, то вакансия отображается на языке по умолчанию (en).

Для реализации использовать Zend Framework 2.x, Doctrine 2 и composer. Результат необходимо выложить на Github.com.

Дополнительный плюсы
--------------------

 - соответсвие кода Zend Coding Style
 - наличие валидных докблоков с комментариями на англ
 - более одного коммита в истории гитхаба
 - покрытие unit тестами