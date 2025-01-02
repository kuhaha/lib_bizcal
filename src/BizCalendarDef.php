<?php
namespace ksu\bizcal;

class BizCalendarDef
{

    const BIZDAY_TYPE = [
        'OpenDay' => '営業日',
        'CloseDay' => '休業日',
        'WeekDay' => '平日',
        'WeekEnd' => '週末',
        'Holiday' => '祝日',
    ];

    const BIZDAY_DEF = [
        'Priority' => [ 
            'OpenDay', 'CloseDay', // priori to open when both open and close are defined
        ],
        'CloseDay'=> [ // routinely close days of week
            [
                'wdays' => [0, 6],
                'months' => [1,2,3],
            ], 
            [
                'wdays' => [2, 3],
                'months' => [9,10,11,12],
            ], 
        ],
        'OpenDay' => [ // special open days
            'mdays' =>  ['8-11', '10-14'],
        ],
    ];
}