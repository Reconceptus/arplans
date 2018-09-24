<?php

use yii\db\Migration;

/**
 * Class m180913_063418_create_villages
 */
class m180913_063418_create_villages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('region', [
            'id'        => $this->primaryKey()->unsigned(),
            'slug'      => $this->string(),
            'name'      => $this->string(),
            'center'    => $this->string(),
            'sort'      => $this->integer(),
            'is_active' => $this->smallInteger(1)
        ]);

        $regions = [
            ['adygeya', 'Адыгея', 'Майкоп', 200, 1],
            ['altay', 'Алтай', 'Горно-Алтайск', 200, 1],
            ['bashkortostan', 'Башкортостан', 'Уфа', 200, 1],
            ['buryatia', 'Бурятия', 'Улан-Удэ', 200, 1],
            ['dagestan', 'Дагестан', 'Махачкала', 200, 1],
            ['ingushetia', 'Ингушетия', 'Магас', 200, 1],
            ['kbr', 'Кабардино-Балкария', 'Нальчик', 200, 1],
            ['kalmykia', 'Калмыкия', 'Элиста', 200, 1],
            ['kcr', 'Карачаево-Черкесия', 'Черкесск', 200, 1],
            ['karelia', 'Карелия', 'Петрозаводск', 200, 1],
            ['komi', 'Коми', 'Сыктывкар', 200, 1],
            ['crimea', 'Крым', 'Симферополь', 200, 1],
            ['mariyel', 'Марий Эл', 'Йошкар-Ола', 200, 1],
            ['mordovia', 'Мордовия', 'Саранск', 200, 1],
            ['saha', 'Саха (Якутия)', 'Якутск', 200, 1],
            ['soa', 'Северная Осетия — Алания', 'Владикавказ', 200, 1],
            ['tatarstan', 'Татарстан', 'Казань', 200, 1],
            ['tyva', 'Тыва', 'Кызыл', 200, 1],
            ['udmurtia', 'Удмуртия', 'Ижевск', 200, 1],
            ['hakasia', 'Хакасия', 'Абакан', 200, 1],
            ['chechnya', 'Чечня', 'Грозный', 200, 1],
            ['chuvashia', 'Чувашия', 'Чебоксары', 200, 1],
            ['altaykray', 'Алтайский край', 'Барнаул', 200, 1],
            ['zabaykal', 'Забайкальский край', 'Чита', 200, 1],
            ['kamchatka', 'Камчатский край', 'Петропавловск-Камчатский', 200, 1],
            ['krasnodar', 'Краснодарский край', 'Краснодар', 200, 1],
            ['krasnoyarsk', 'Красноярский край', 'Красноярск', 200, 1],
            ['perm', 'Пермский край', 200, 'Пермь', 1],
            ['primorie', 'Приморский край', 200, 'Владивосток', 1],
            ['stavropol', 'Ставропольский край', 'Ставрополь', 200, 1],
            ['khabarovsk', 'Хабаровский край', 'Хабаровск', 200, 1],
            ['amurskaya', 'Амурская область', 'Благовещенск', 200, 1],
            ['arhangelsk', 'Архангельская область', 'Архангельск', 200, 1],
            ['astrakhan', 'Астраханская область', 'Астрахань', 200, 1],
            ['belgorod', 'Белгородская область', 'Белгород', 200, 1],
            ['bryansk', 'Брянская область', 'Брянск', 200, 1],
            ['vladimir', 'Владимирская область', 'Владимир', 200, 1],
            ['volgograd', 'Волгоградская область', 'Волгоград', 200, 1],
            ['vologda', 'Вологодская область', 'Вологда', 200, 1],
            ['voronezh', 'Воронежская область', 'Воронеж', 200, 1],
            ['ivanovo', 'Ивановская область', 'Иваново', 200, 1],
            ['irkutsk', 'Иркутская область', 'Иркутск', 200, 1],
            ['kaliningrad', 'Калининградская область', 'Калининград', 200, 1],
            ['kaluga', 'Калужская область', 'Калуга', 200, 1],
            ['kemerovo', 'Кемеровская область', 'Кемерово', 200, 1],
            ['kirov', 'Кировская область', 'Киров', 200, 1],
            ['kostroma', 'Костромская область', 'Кострома', 200, 1],
            ['kurgan', 'Курганская область', 'Курган', 200, 1],
            ['kursk', 'Курская область', 'Курск', 200, 1],
            ['leningradskaya', 'Ленинградская область', 'Санкт-Петербург', 200, 1],
            ['lipetsk', 'Липецкая область', 'Липецк', 200, 1],
            ['magadan', 'Магаданская область', 'Магадан', 200, 1],
            ['moskovskaya', 'Московская область', 'Москва', 200, 1],
            ['murmansk', 'Мурманская область', 'Мурманск', 200, 1],
            ['nnov', 'Нижегородская область', 'Нижний Новгород', 200, 1],
            ['velnov', 'Новгородская область', 'Великий Новгород', 200, 1],
            ['novosibirsk', 'Новосибирская область', 'Новосибирск', 200, 1],
            ['omsk', 'Омская область', 'Омск', 200, 1],
            ['orenburg', 'Оренбургская область', 'Оренбург', 200, 1],
            ['orel', 'Орловская область', 'Орёл', 200, 1],
            ['penza', 'Пензенская область', 'Пенза', 200, 1],
            ['pskov', 'Псковская область', 'Псков', 200, 1],
            ['rostov', 'Ростовская область', 'Ростов-на-Дону', 200, 1],
            ['ryazan', 'Рязанская область', 'Рязань', 200, 1],
            ['samara', 'Самарская область', 'Самара', 200, 1],
            ['saratov', 'Саратовская область', 'Саратов', 200, 1],
            ['sakhalin', 'Сахалинская область', 'Южно-Сахалинск', 200, 1],
            ['sverdlovskaya', 'Свердловская область', 'Екатеринбург', 200, 1],
            ['smolensk', 'Смоленская область', 'Смоленск', 200, 1],
            ['tambov', 'Тамбовская область', 'Тамбов', 200, 1],
            ['tver', 'Тверская область', 'Тверь', 200, 1],
            ['tomsk', 'Томская область', 'Томск', 200, 1],
            ['tula', 'Тульская область', 'Тула', 200, 1],
            ['tyumen', 'Тюменская область', 'Тюмень', 200, 1],
            ['ulyanovsk', 'Ульяновская область', 'Ульяновск', 200, 1],
            ['chelyabinsk', 'Челябинская область', 'Челябинск', 200, 1],
            ['yaroslavl', 'Ярославская область', 'Ярославль', 200, 1],
            ['eao', 'Еврейская АО', 'Биробиджан', 200, 1],
            ['moscow', 'Москва', 'Москва', 200, 1],
            ['spb', 'Санкт-Петербург', 'Санкт-Петербург', 200, 1],
            ['sevastopol', 'Севастополь', 'Севастополь', 200, 1],
            ['nao', 'Ненецкий АО', 'Нарьян-Мар', 200, 1],
            ['hmao', 'Ханты-Мансийский АО-Югра', 'Ханты-Мансийск', 200, 1],
            ['chao', 'Чукотский АО', 'Анадырь', 200, 1],
            ['yanao', 'Ямало-Ненецкий АО', 'Салехард', 200, 1],
        ];
        $this->batchInsert('region', ['slug', 'name', 'center', 'sort', 'is_active'], $regions);

        $this->createIndex('U_region_slug', 'region', 'slug', true);
        $this->createIndex('U_region_name', 'region', 'name', true);


        $this->createTable('village', [
            'id'                => $this->primaryKey()->unsigned(),
            'name'              => $this->string(),
            'slug'              => $this->string(),
            'address'           => $this->string(),
            'phones'            => $this->string(),
            'url'               => $this->string(),
            'price_list'        => $this->string(),
            'logo'              => $this->string(),
            'region_id'         => $this->integer()->unsigned(),
            'electric'          => $this->boolean(),
            'gas'               => $this->boolean(),
            'water'             => $this->boolean(),
            'internet'          => $this->boolean(),
            'gas_boiler'        => $this->boolean(),
            'territory_control' => $this->boolean(),
            'fire_alarm'        => $this->boolean(),
            'security_alarm'    => $this->boolean(),
            'shop'              => $this->boolean(),
            'children_club'     => $this->boolean(),
            'sports_center'     => $this->boolean(),
            'sports_ground'     => $this->boolean(),
            'golf_club'         => $this->boolean(),
            'beach'             => $this->boolean(),
            'life_service'      => $this->boolean(),
            'forest'            => $this->boolean(),
            'reservoir'         => $this->boolean()
        ]);
        $this->createIndex('U_village_slug', 'region', 'slug', true);
        $this->createIndex('U_village_name', 'region', 'name', true);

        $this->createTable('village_image', [
            'id'         => $this->primaryKey()->unsigned(),
            'village_id' => $this->integer()->unsigned(),
            'file'       => $this->string(),
            'thumb'      => $this->string(),
            'sort'       => $this->integer()
        ]);

        $this->createTable('village_benefit', [
            'id'         => $this->primaryKey()->unsigned(),
            'village_id' => $this->integer()->unsigned(),
            'name'       => $this->string(),
            'text'       => $this->string(500)
        ]);

        $this->addColumn('partner', 'slug', $this->string());
        $this->addColumn('partner', 'region_id', $this->integer()->unsigned());
        $this->addColumn('partner', 'glued_timber', $this->boolean());
        $this->addColumn('partner', 'profiled_timber', $this->boolean());
        $this->addColumn('partner', 'wooden_frame', $this->boolean());
        $this->addColumn('partner', 'lstk', $this->boolean());
        $this->addColumn('partner', 'carcass', $this->boolean());
        $this->addColumn('partner', 'combined', $this->boolean());
        $this->addColumn('partner', 'brick', $this->boolean());
        $this->addColumn('partner', 'block', $this->boolean());

        $this->addColumn('partner', 'finishing', $this->boolean());
        $this->addColumn('partner', 'santech', $this->boolean());
        $this->addColumn('partner', 'electric', $this->boolean());

        $this->addColumn('partner', 'wooden', $this->boolean());
        $this->addColumn('partner', 'stone', $this->boolean());
        $this->addColumn('partner', 'roof', $this->boolean());
        $this->addColumn('partner', 'windows', $this->boolean());
        $this->addColumn('partner', 'stretch_ceiling', $this->boolean());

        $this->addColumn('partner', 'surround_region', $this->boolean());
        $this->addColumn('partner', 'any_region', $this->boolean());

        $this->createIndex('U_partner_slug', 'partner', 'slug', true);

        $this->createTable('partner_image', [
            'id'         => $this->primaryKey()->unsigned(),
            'partner_id' => $this->integer()->unsigned(),
            'file'       => $this->string(),
            'thumb'      => $this->string(),
            'sort'       => $this->integer()
        ]);

        $this->createTable('partner_benefit', [
            'id'         => $this->primaryKey()->unsigned(),
            'partner_id' => $this->integer()->unsigned(),
            'name'       => $this->string(),
            'text'       => $this->string(500)
        ]);

        $this->addForeignKey('FK_partner_image_partner', 'partner_image', 'partner_id', 'partner', 'id');
        $this->addForeignKey('FK_partner_region', 'partner', 'region_id', 'region', 'id');
        $this->addForeignKey('FK_village_benefit_village', 'village_benefit', 'village_id', 'village', 'id');
        $this->addForeignKey('FK_village_region', 'village', 'region_id', 'region', 'id');
        $this->addForeignKey('FK_village_image_village', 'village_image', 'village_id', 'village', 'id');
        $this->addForeignKey('FK_partner_benefit_partner', 'partner_benefit', 'partner_id', 'partner', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_village_region', 'village');
        $this->dropForeignKey('FK_partner_region', 'partner');
        $this->dropForeignKey('FK_village_image_village', 'village_image');
        $this->dropForeignKey('FK_partner_image_partner', 'partner_image');
        $this->dropForeignKey('FK_partner_benefit_partner', 'partner_benefit');
        $this->dropForeignKey('FK_village_benefit_village', 'village_benefit');

        $this->dropColumn('partner', 'slug');
        $this->dropColumn('partner', 'region_id');
        $this->dropColumn('partner', 'glued_timber');
        $this->dropColumn('partner', 'profiled_timber');
        $this->dropColumn('partner', 'wooden_frame');
        $this->dropColumn('partner', 'lstk');
        $this->dropColumn('partner', 'carcass');
        $this->dropColumn('partner', 'combined');
        $this->dropColumn('partner', 'brick');
        $this->dropColumn('partner', 'block');
        $this->dropColumn('partner', 'finishing');
        $this->dropColumn('partner', 'santech');
        $this->dropColumn('partner', 'electric');
        $this->dropColumn('partner', 'wooden');
        $this->dropColumn('partner', 'stone');
        $this->dropColumn('partner', 'roof');
        $this->dropColumn('partner', 'windows');
        $this->dropColumn('partner', 'stretch_ceiling');
        $this->dropColumn('partner', 'surround_region');
        $this->dropColumn('partner', 'any_region');

        $this->dropTable('village');
        $this->dropTable('region');
        $this->dropTable('village_image');
        $this->dropTable('partner_image');
        $this->dropTable('village_benefit');
        $this->dropTable('partner_benefit');
    }
}
