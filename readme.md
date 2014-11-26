# Kompakt B3d

Berlin3 Details API Connector

## Description

## Install

+ `git clone https://github.com/kompakt/b3d.git`
+ `cd b3d`
+ `curl -sS https://getcomposer.org/installer | php`
+ `php composer.phar install`

## Tests

+ `cp tests/config.php.dist config.php`
+ Adjust `config.php` as needed
+ `vendor/bin/phpunit`

## Examples

+ `cp example/config.php.dist config.php`
+ Adjust `config.php` as needed

## Entities

    Kompakt\B3d\Entity\Artist Object
    (
        [name] => Bedroom Community
        [mechanicalId] =>
        [bioEngl] =>
        [bioOwn] =>
        [notes] =>
        [artwork1] =>
        [artwork2] =>
        [url1] =>
        [url2] =>
        [labelArtistId] => 1139
        [sortName] =>
        [amgId] =>
    )

    Kompakt\B3d\Entity\Label Object
    (
        [id] => 1001
        [name] => Kompakt
        [code] => 12012
        [infoEnglish] =>
        [infoSecond] =>
        [url1] => www.kompakt.fm
        [url2] =>
        [artwork1] =>
        [artwork2] =>
        [defaultCLine] => Kompakt
        [defaultPLine] => Kompakt
        [isrcBase] => DE U6
        [territoryId] =>
        [notes] => Kompakt
    )

    Kompakt\B3d\Entity\Product Object
    (
        [id] => 2422
        [catalogNumber] => FAT 002
        [streamYesNo] =>
        [identifier] =>
        [digitalPhysical] => physical
        [supplierId] =>
        [weight] =>
        [releaseShift] => 0
        [infoEnglish] =>
        [infoSecond] =>
        [releaseId] =>
        [downloadYesNo] =>
        [deliveryNow] =>
        [deliveryConfirmedDate] =>
        [barcode] => 880319180514
        [deliveredFlag] =>
        [deliveredDate] =>
        [deliveryConfirmedFlag] =>
        [attribute1] =>
        [attribute2] =>
        [attribute3] =>
        [formatId] => 1296
        [artworkProduct1] =>
        [artworkProduct2] =>
        [priceCodeId] => 5223
        [language] =>
        [ppd] =>
        [version] =>
        [costPrice] =>
        [notes] =>
        [typeId] =>
    )

    Kompakt\B3d\Entity\Release Object
    (
        [status] => imported
        [title] => AY AY AY
        [titleAlt] =>
        [infoEnglish] => Chilean born... 
        [identifier] =>
        [artist] => Matias Aguayo
        [artwork1] =>
        [artwork2] =>
        [projectId] =>
        [id] => 4065
        [releaseDate] => DateTime Object
            (
                [date] => 2009-10-26 00:00:00
                [timezone_type] => 3
                [timezone] => Europe/Paris
            )

        [type] => album
        [notes] =>
        [labelId] => 1001
    )

    Kompakt\B3d\Entity\Track Object
    (
        [id] => 10485
        [productIdMain] => 4065
        [songId] =>
        [country] =>
        [artworkTrack1] =>
        [version] =>
        [isrc] => DEU670900094
        [pYear] => 2009
        [pLine] => Kompakt
        [digitalRightType] => 1
        [artist] => Matias Aguayo
        [playtime] => 00:06:04
        [title] => AY AY AY
        [type] => audio
        [explicitFlag] => 0
    )

## License

kompakt/b3d is licensed under the MIT license - see the LICENSE file for details