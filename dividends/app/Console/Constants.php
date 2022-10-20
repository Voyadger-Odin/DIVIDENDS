<?php

namespace App\Console;

class Constants{

    const sectors = [
        'energy' => 'Энергетика',
        'it' => 'IT',
        'consumer' => 'Потребительские товары и услуги',
        'materials' => 'Сырьевая промышленность',
        'real_estate' => 'Недвижимость',
        'industrials' => 'Машиностроение и транспорт',
        'utilities' => 'Электроэнергетика',
        'telecom' => 'Телекоммуникации',
        'health_care' => 'Здравоохранение',
        'green_buildings' => 'Энергоэффективные здания',
        'financial' => 'Финансовый сектор',
        'electrocars' => 'Электротранспорт и комплектующие',
        'ecomaterials' => 'Материалы для эко-технологий',
        'other' => 'Другое',
    ];

    public static function Sectors()
    {
        return self::sectors;
    }

}
