# Kompakt B3d

Berlin3 "Details" API Connector, Schema Loader & Canonical Product Builder

## Description

Get data from "Details" endpoints, optionally cache results, load full graph per "Details" schema, build canonical product representation and serialize result to xml files.

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

## License

kompakt/b3d is licensed under the MIT license - see the LICENSE file for details