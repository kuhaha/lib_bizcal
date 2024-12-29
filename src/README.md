# PHP `DateTime`, `DateTimeImmutable`

 `DateTime` クラスは、`add(), modify(), sub(), set??()` のような、 オブジェクトそのものを変更するメソッドが呼び出された時を除き `DateTimeImmutable` と同じ振る舞いをする。 

- `DateTimeImmutable::__construct()` — 新しい `DateTimeImmutable` オブジェクトを返す

- `DateTimeImmutable::createFromFormat()` — 時刻の文字列を指定されたフォーマットに従ってパースする

- `DateTimeImmutable::createFromInterface()` — 指定された `DateTimeInterface` オブジェクトをカプセル化した、新しい DateTimeImmutable オブジェクトを返す

- `DateTimeImmutable::createFromMutable()` — 与えられた `DateTime` オブジェクトをカプセル化した、新しいDateTimeImmutable のインスタンスを返す

- `DateTimeImmutable::getLastErrors()` — 警告およびエラーを返す

- `DateTimeImmutable::add()` — 年月日時分秒の値を加え、**新しいオブジェクトを返す**

- `DateTime::add()` — 年月日時分秒の値を加えることで、`DateTime` **オブジェクトを変更する**

- `modify()` 

    - `DateTimeImmutable::modify()` — タイムスタンプを変更した**新しいオブジェクトを作る**

        ```php
        <?php
        $date = new DateTimeImmutable('2006-12-12');
        $newDate = $date->modify('+1 day'); // state immutable
        echo $newDate->format('Y-m-d');// 2006-12-13
        echo $date->format('Y-m-d');// 2006-12-12
        ?>
        ```
    
    - `DateTime::modify()`  — **タイムスタンプを変更する**
    
       ```php
       <?php
          $date = new DateTime('2006-12-12');
          $date->modify('+1 day'); // state mutable
          echo $date->format('Y-m-d');// 2006-12-13
          ?>
- `DateTimeImmutable::__set_state()` — __set_state ハンドラ

- `DateTimeImmutable::setDate()` — 日付を設定する

- `DateTimeImmutable::setISODate()` — ISO 日付を設定する

- `DateTimeImmutable::setTime()` — 時刻を設定する

- `DateTimeImmutable::setTimestamp()` — Unix タイムスタンプを用いて日付と時刻を設定する

- `DateTimeImmutable::setTimezone()` — タイムゾーンを設定する

- `DateTimeImmutable::sub()` — 年月日時分秒の値を引く

 

# Python Calendar, Date and Time

https://docs.python.org/3.13/library/calendar.html#module-calendar

- `calendar`: provides calendar printing functions like `cal(1)` Linux program
- `datetime`: contains all the information from a `date` object and a `time` object
- `date`: represents a date (year, month and day) in an idealized calendar
- `time`: represents a (local) time of day
- `timedelta`: represents a duration, the difference between two `datetime` or `date` instances.



## `date`

- `date, year, month, day, resolution, min, max`
- `today()`, `weekday()`
- `fromtimestamp()`, `fromordinal()`, `fromisoformat()`, `fromisocalendar()`
- `replace()` returns a date with the same value, except for those parameters given new values by whichever keyword arguments are specified.
- `ctime()`, `strftime()`

## `time`

- `time, hour, minute, second, microsecond, tzinfo, resolution, fold, min, max`
- `replace()` returns a date with the same value, except for those parameters given new values by whichever keyword arguments are specified.
- `fromisoformat()`
- `utcoffset()`, `dst()`
- `tzname()`

## `datetime`

- `datetime, year, month, day, hour, minute, second, microsecond, tzinfo, resolution, fold, min, max`
- `today()`, `now()`, `utcnow()`
- `fromtimestamp()`, `utcfromtimestamp()`, `fromordinal()`, `fromisoformat()`, `fromisocalendar()`
- `strptime()`, `strftime()`
- `date()`, `time()`, `timestamp()`
- `timetz()`, `tzname()`
- `timetuple()`, `utctimetuple()`
- `replace()` returns a date with the same value, except for those parameters given new values by whichever keyword arguments are specified.
-  `toordinal()`
- `combine()`
- `weekday()`, `isoweekday()`, `isoformat()`



## `calendar`
- `iterweekdays()`
- `itermonthdates()`
- `itermonthdays()`
- `itermonthdays2()`
- `itermonthdays3()`
- `itermonthdays4()`
- `monthdatescalendar()`
- `monthdays2calendar()`
- `monthdayscalendar()`
- `yeardatescalendar()`
- `yeardays2calendar()`
- `yeardayscalendar()`

| **Methods**      | **Description** |
|-------------------|-------------------|
| `Calendar(firstweekday = 0)` | Creates a `Calendar` object. `firstweekday` is an integer specifying the first day of the week. `MONDAY` is `0` (the default), `SUNDAY` is `6`. |
| `iterweekdays()`  | Return an iterator for the week day numbers that will be used for one week. |
| `itermonthdates(year, month)` | Return an iterator for the month `month` (1–12) in the year `year`. This iterator will return all days (as `datetime.date` objects) for the month and all days before the start of the month or after the end of the month that are required to get a complete week. |
| `itermonthdays(year, month)` | Return an iterator for the month *month* in the year *year* similar to `itermonthdates()`, but not restricted by the `datetime.date` range. Days returned will simply be day of the month numbers. For the days outside of the specified month, the day number is `0`. |
| `itermonthdays2(year, month)` | Return an iterator for the month *month* in the year *year* similar to `itermonthdates()`, but not restricted by the `datetime.date` range. Days returned will be tuples consisting of a day of the month number and a week day number. |
| `itermonthdays3(year, month)` | Return an iterator for the month *month* in the year *year* similar to `itermonthdates()`, but not restricted by the `datetime.date` range. Days returned will be tuples consisting of a year, a month and a day of the month numbers. |
| `itermonthdays4(year, month)` | Return an iterator for the month *month* in the year *year* similar to `itermonthdates()`, but not restricted by the `datetime.date` range. Days returned will be tuples consisting of a year, a month, a day of the month, and a day of the week numbers. |
| `monthdatescalendar(year, month)` | Return a list of the weeks in the month *month* of the *year* as full weeks. Weeks are lists of seven `datetime.date` objects. |
| `monthdays2calendar(year, month)` | Return a list of the weeks in the month *month* of the *year* as full weeks. Weeks are lists of seven tuples of day numbers and weekday numbers. |
| `monthdatescalendar(year, month)` | Return a list of the weeks in the month *month* of the *year* as full weeks. Weeks are lists of seven day numbers. |
| `yeardayscalendar(year, width=3)` | Return the data for the specified year ready for formatting. The return value is a list of month rows. Each month row contains up to *width* months (defaulting to 3). Each month contains between 4 and 6 weeks and each week contains 1–7 days. Days are `datetime.date` objects |
| `yeardays2calendar(year, width=3)`| Return the data for the specified year ready for formatting (similar to `yeardatescalendar()`). Entries in the week lists are tuples of day numbers and weekday numbers. Day numbers outside this month are zero. |
| `yeardayscalendar(year, width=3)`| Return the data for the specified year ready for formatting (similar to `yeardatescalendar()`). Entries in the week lists are day numbers. Day numbers outside this month are zero. |