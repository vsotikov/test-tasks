# Ottivo Employees Vacation Calculator

This command line tool calculates the amount of vacation days available to Ottivo employees annually. Calculation is based on defined rules, that are described in `VacationDaysCalculator/Handlers` directory. Employee's information is stored in `DataSource/Employees` class.

To run the command you should navigate to program root directory (the directory with this file) and launch command in a following way

```bash
/usr/bin/php index.php YYYY
```

where YYYY is an integer value representing a year for which calculation if made for. Examples:

```bash
/usr/bin/php index.php 2001
/usr/bin/php index.php 2016
/usr/bin/php index.php 2017
/usr/bin/php index.php 2018
/usr/bin/php index.php 2021
/usr/bin/php index.php 2100
```

An example of command output

```bash
# /usr/bin/php index.php 2021
================================================================================
Hans Mueller: 30.0 vacation days
Angelika Fringe: 30.0 vacation days
Peter Klever: 28.0 vacation days
Marina Helter: 26.0 vacation days
Sepp Meier: 26.0 vacation days
================================================================================
```


# Initial Task Requirements

## for PHP Developers

We ask you to build a simple PHP application around a set of fictional requirements, by investing
ideally no more than a few hours of your time. Implement this the same as you would implement a
feature in your normal day to day work. Aim for a clean well thought out yet pragmatic design. It
allows us to get a feeling for your PHP coding skills and how you engineer solutions.

## The Task

The fictional company _Ottivo_ wants to determine each of its employee's yearly vacation days for a
given year.

Requirements:

- Each employee has a minimum of 26 vacation days regardless of age^
- A special contract can overwrite the amount of minimum vacation days^
- Employees >= 30 years get one additional vacation day every 5 years^
- Contracts can start on the 1st or the 15th of a month^
- Contracts starting in the course of the year get 1/12 of the yearly vacation days for each full
    month

List of employees:

For your solution, please implement a **command line script** that takes the year of interest as an
input argument and outputs the employees names with the respective number of vacation days.

Please avoid using a database to store the employees and include a README file documenting
how to setup and run the command as well as its tests. If you feel that there are ambiguities in the
requirements, feel free to make assumptions and also document them.

Name | Date of Birth | Contract Start Date | Special Contract
------------ | ------------- | ------------- | -------------
Hans Müller | 30.12.1950 | 01.01.2001 |
Angelika Fringe | 09.06.1966 | 15.01.2001 |
Peter Klever | 12.07.1991 | 15.05.2016 | 27 vacation days
Marina Helter | 26.01.1970 | 15.01.2017 |
Sepp Meier | 23.05.1980 | 01.12.2018 |
