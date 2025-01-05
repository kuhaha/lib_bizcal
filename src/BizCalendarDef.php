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

    //By default what a day is except specified otherwise
    const DEFAULT = 'OpenDay'; // 'CloseDay'; 

    const BIZDAY_DEF = [      
        
        'CloseDay'=> [ 
            [ // routinely close days of week
                'wdays' => [0, 6],  // these days of week are close days
                'months-except' => [1, 8],
                // default for every month of the year
            ],
            [ // routinely close days of week
                'wdays' => [4],  //　these days of week are close days
                'months-for' => [1, 8], // for these months
            ], 
            [   // special close days
                'mdays' => ['3-20', '1-15'],
            ],
        ],

        'OpenDay' => [ // special open days
            [
                'mdays' =>  ['3-12', '1-14', ],
            ],
        ],
    ];
}