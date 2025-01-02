<?php
namespace ksu\bizcal;

class BizHolidayDef
{
    /**
     * <holiday> ::= array[<month_def>]
     * <month_def> ::= array[<month> => <day_def>]
     * <day_def> ::= array[<id>, <day>, <between>, <except>, <only>]
     * default <between> [1948, 2999] 
     */
    const HOLIDAY_SINCE = 1948;
    
    const _ID = 'id';
    const _DAY = 'day';
    const _BET = 'between';
    const _EXP = 'except';
    const _ONL = 'only';

    const HOLIDAY_NAME = [
      'NewYearsDay' => '元日',
      'ComingOfAgeDay' => '成人の日',
      'NationalFoundationDay' => '建国記念の日',
       'SpringEquinox' => '春分の日',
      'ShowaDay' => '昭和の日',
      'ConstitutionMemorialDay' => '憲法記念日',
      'GreeneryDay' => 'みどりの日',
      'ChildrensDay' => 'こどもの日',
      'MarineDay' => '海の日',
      'SportsDay' => 'スポーツの日',
      'MountainDay' => '山の日',
      'RespectForTheAgeDay' => '敬老の日',
      'AutumnalEquinoxDay' => '秋分の日',
      'HealthSportsDay' => '体育の日',
      'SportsDay' => 'スポーツの日',
      'CultureDay' => '文化の日',
      'LaborThanksgivingDay' => '勤労感謝の日',
      'EmperorsBirthday' => '天皇誕生日',
      'EnthronementProclamationCeremony' => '即位礼正殿の儀',
      'CoronationDay' => '天皇の即位の日',
      'SubstituteHoliday' => '振替休日', 
      'BridgeHoliday' => '国民の休日',
    ];

    const HOLIDAY_DEF = [
      1 => [ 
        [ 'id' => 'NewYearsDay', 
          'day' => 1 
        ],
        [ 'id' => 'ComingOfAgeDay',
          'day' => 15, 
          'between'=>[1948,1999]
        ],
        [ 'id' => 'ComingOfAgeDay',
          'day' => [2, 1], # 2nd Monday
          'between'=>[2000,2999]
        ]
      ],
      2 => [  
        [ 'id' => 'NationalFoundationDay',
          'day' => 11,
          'between' => [1966, 2999]
        ], 
        [ 'id' => 'EmperorsBirthday', # 令和天皇
          'day' => 23,
          'between' => [2020, 2999]
        ],
      ],
      3 => [ 
        [ 'id' => 'SpringEquinox',
          'day' => 'springEquinox',
        ],
      ],
      4 => [  
        [ 'id' => 'ShowaDay',
          'day' => 29,
          'between' => [1989, 2999]
        ],
        [ 'id' => 'EmperorsBirthday', # 昭和天皇
          'day' => 29,
          'between' => [1910, 1988]
        ], 
      ],
      5 => [  
        [ 'id' => 'CoronationDay',
          'day' => 1,
          'only' => [2019]
        ],
        [ 'id' => 'ConstitutionMemorialDay',
          'day' => 3,
        ],
        [ 'id' => 'GreeneryDay',
          'day' => 4,
        ],
        [ 'id' => 'ChildrensDay',
          'day' => 5
        ],
      ],
      7 =>[ 
        [ 'id' => 'MarineDay',
          'day' => [3, 1], # 3rd Monday
          'except' => [2020, 2021]
        ], 
        [ 'id' => 'MarineDay',
          'day' => 22,
          'only' => [2021]
        ],
        [ 'id' => 'MarineDay',
          'day' => 23,
          'only' => [2020]
        ],
        [ 'id' => 'SportsDay',
          'day' => 24,
          'only' => [2020]
        ],
        [ 'id' => 'SportsDay',
          'day' => 23,
          'only' => [2021]
        ],
      ],  
      8 => [  
        [ 'id' => 'MountainDay',
          'day' => 11,
          'except' => [2020, 2021]
        ],
        [ 'id' => 'MountainDay',
          'day' => 8,
          'only' => [2021]
        ], 
        [ 'id' => 'MountainDay',
          'day' => 10, 
          'only' => [2020]
        ],
      ],
      9 => [  
        [ 'id' => 'RespectForTheAgeDay',
          'day' => [3, 1] # 3rd Monday
        ],
        [ 'id' => 'AutumnalEquinoxDay',
          'day' => 'autumnEquinox',
        ],
      ],
      10 => [  
        [ 'id' => 'HealthSportsDay',
          'day' => 10,
          'between' => [1966, 1999]
        ], 
        [ 'id' => 'HealthSportsDay',
          'day' => [2,1],
          'between' => [2000, 2019]
        ],
        [ 'id' => 'SportsDay',
          'day' => [2,1],
          'between' => [2022, 2999]
        ],
        [ 'id' => 'EnthronementProclamationCeremony',
          'day' => 22,
          'only' => [2019]
        ],
      ],
      11 => [  
        [ 'id' => 'CultureDay',
          'day' => 3
        ],
        [ 'id' => 'LaborThanksgivingDay',
          'day' => 23
        ],
      ],
      12 => [ 
        [ 'id' => 'EmperorsBirthday', # 平成天皇
          'day' => 23,
          'between' => [1989, 2018]
        ],
      ]
    ];
}