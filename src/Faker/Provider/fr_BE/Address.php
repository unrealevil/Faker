<?php

namespace Faker\Provider\fr_BE;

class Address extends \Faker\Provider\fr_FR\Address
{
    protected static array $postcode = ['####'];

    protected static array $streetAddressFormats = [
        '{{streetName}} {{buildingNumber}}',
    ];

    protected static array $streetNameFormats = ['{{streetSuffix}} {{lastName}}'];

    protected static array $cityFormats = ['{{cityName}}'];

    protected static array $addressFormats = [
        "{{streetAddress}}\n {{postcode}} {{city}}",
    ];

    protected static array $streetSuffix = [
        'rue',
        'avenue',
        'boulevard',
        'chemin',
        'chaussée',
        'impasse',
        'place',
    ];

    /**
     * Source: http://fr.wikipedia.org/wiki/Ville_de_Belgique.
     */
    protected static array $cityNames = [
        'Aarschot',
        'Alost',
        'Andenne',
        'Antoing',
        'Anvers',
        'Arlon',
        'Ath',
        'Audenarde',
        'Bastogne',
        'Beaumont',
        'Beauraing',
        'Beringen',
        'Bilzen',
        'Binche',
        'Blankenberge',
        'Bouillon',
        'Braine-le-Comte',
        'Bree',
        'Bruges',
        'Bruxelles',
        'Charleroi',
        'Châtelet',
        'Chièvres',
        'Chimay',
        'Chiny',
        'Ciney',
        'Comines-Warneton',
        'Courtrai',
        'Couvin',
        'Damme',
        'Deinze',
        'Diest',
        'Dilsen-Stokkem',
        'Dinant',
        'Dixmude',
        'Durbuy',
        'Eeklo',
        'Enghien',
        'Eupen',
        'Fleurus',
        'Florenville',
        'Fontaine-l\'Évêque',
        'Fosses-la-Ville',
        'Furnes',
        'Gand',
        'Geel',
        'Gembloux',
        'Genappe',
        'Genk',
        'Gistel',
        'Grammont',
        'Hal',
        'Halen',
        'Hamont-Achel',
        'Hannut',
        'Harelbeke',
        'Hasselt',
        'Herck-la-Ville',
        'Herentals',
        'Herstal',
        'Herve',
        'Hoogstraten',
        'Houffalize',
        'Huy',
        'Izegem',
        'Jodoigne',
        'La Louvière',
        'La Roche-en-Ardenne',
        'Landen',
        'Léau',
        'Le Rœulx',
        'Lessines',
        'Leuze-en-Hainaut',
        'Liège',
        'Lierre',
        'Limbourg',
        'Lokeren',
        'Lommel',
        'Looz',
        'Lo-Reninge',
        'Louvain',
        'Maaseik',
        'Malines',
        'Malmedy',
        'Marche-en-Famenne',
        'Menin',
        'Messines',
        'Mons',
        'Montaigu-Zichem',
        'Mortsel',
        'Mouscron',
        'Namur',
        'Neufchâteau',
        'Nieuport',
        'Ninove',
        'Nivelles',
        'Ostende',
        'Ottignies-Louvain-la-Neuve',
        'Oudenburg',
        'Peer',
        'Péruwelz',
        'Philippeville',
        'Poperinge',
        'Renaix',
        'Rochefort',
        'Roulers',
        'Saint-Ghislain',
        'Saint-Hubert',
        'Saint-Nicolas',
        'Saint-Trond',
        'Saint-Vith',
        'Seraing',
        'Soignies',
        'Stavelot',
        'Termonde',
        'Thuin',
        'Tielt',
        'Tirlemont',
        'Tongres',
        'Torhout',
        'Tournai',
        'Turnhout',
        'Verviers',
        'Vilvorde',
        'Virton',
        'Visé',
        'Walcourt',
        'Waregem',
        'Waremme',
        'Wavre',
        'Wervik',
        'Ypres',
        'Zottegem',
    ];

    protected static array $region = [
        'Wallonie',
        'Flandre',
        'Bruxelles-Capitale',
    ];

    protected static array $province = [
        'Anvers',
        'Limbourg',
        'Flandre orientale',
        'Brabant flamand',
        'Flandre occidentale',
        'Hainaut',
        'Liège',
        'Luxembourg',
        'Namur',
        'Brabant wallon',
    ];

    /**
     * Randomly returns a belgian province.
     *
     * @example 'Hainaut'
     */
    public static function province(): string
    {
        return static::randomElement(static::$province);
    }

    /**
     * @see parent
     */
    public function cityName()
    {
        return static::randomElement(static::$cityNames);
    }
}
