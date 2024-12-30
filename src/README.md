## PHP BizCalendar, BizDateTime

## BizCalendar
|  Methods                       |  Description                          | 
|--------------------------------|---------------------------------------|
|`__construct(int $year, int $first_month)`| Create the calendar of a business year - 12 months starting from the `first_month`|
|`today(Day: $day = null): Day`| Set and/or Return the `Day` object of today|
|`isBizday(): bool`| Check if today is a business day|
|`isCloseday(): bool`| Check if today is a closeday|
|`isHoliday(): bool`| Check is today is a holiday|
|`nextBizday(int $n = 1): Day` |Return `n`'th next business day from today| 
|`nextCloseday(int $n = 1): Day`| Return `n`'th next close day from today|
|`nextHoliday(int $n = 1): array`| Return `n`'th hodilay from today|
- ``
- ``
- ``
