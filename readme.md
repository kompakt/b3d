# Kompakt\B3d

Berlin3 [Details](http://berlin3.com) API Wrapper

## Description

Get data from "Details" endpoints, optionally cache results, load full graph per "Details" schema, build canonical product representation and serialize result to xml files.

## Installation

Through Composer:

+ `composer require kompakt/b3d`

## Introduction

The Berlin3 [Details](http://berlin3.com) software for music businesses provides data access in the form of full table dumps. It's up to the user to construct the graph and assemble a data model for further usage. The following entities are available: releases, products, artists, labels, prices, product-tracks, tracks and stock. These entities build up the following structure:

```
+ release (1)
    + label (1)
        + artist (N)
    + product (N)
        + price (N)
        + stock (1)
            + account (N)
        + product-track (N)
            + track (N)
```

## Library Features

+ Data fetchers
+ Data mappers
+ Raw data caching
+ In-memory graph loader
+ Canonical product builder
+ Canonical product serializer
+ Extendable event-based architecture

Internally the data is mapped to temporary entity objects. These entities are then wired up by the graphloader. From there the graph is converted to a product-based datastructure in the from of canonical products. This draws a logical border to avoid "Details" interna to leak into your domain.

```
+ product (contains release-, artist- and labeldata)
    + price (N)
    + track (N)
```

### Fetching

```php
use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint;

$artistEndpoint = new Endpoint(
    new Client(),
    '<artist-endpoint-url>',
    '<api-key>'
);

$rawArtistData = $artistEndpoint->fetchAll();
```
    
### Caching

```php
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer;
use Kompakt\B3d\Util\File\Writer;

$artistSerializer = new Serializer(
    new Writer(),
    'path/to/artist/data/file'
);

$artistSerializer->serialize($rawArtistData);
```

### Populating Entity Repository

Populating from cache:

```php
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Mapper;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Details\Populator\Cache\PhpFile\Populator;

$artistPopulator = new Populator(
    new ArtistMapper(new Artist()),
    new ArtistRepository(),
    new Reader(),
    'path/to/artist/data/file'
);

$artistRepository = $artistPopulator->populate();
$artists = $artistRepository->getAll();
```

The individual parts can also be wired up to directly fetch and populate:

```php
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Mapper;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Details\Populator\Endpoint\Populator;

$artistPopulator = new Populator(
    new ArtistMapper(new Artist()),
    new ArtistRepository(),
    $artistEndpoint
);
```

## Loading the Graph

```php
use Kompakt\B3d\Details\Graph\Loader as GraphLoader;

$graphLoader = new GraphLoader(
    $artistPopulator,
    $labelPopulator,
    $pricePopulator,
    $productPopulator,
    $productTrackPopulator,
    $releasePopulator,
    $trackPopulator
);

$releaseRepository = $graphLoader->load();
```

## Building and Serializing Canonical Products

```php
use Kompakt\B3d\Canonical\Dom\Product\Builder as CanonicalProductDomBuilder;
use Kompakt\B3d\Canonical\Entity\Price as CanonicalPrice;
use Kompakt\B3d\Canonical\Entity\Product as CanonicalProduct;
use Kompakt\B3d\Canonical\Entity\Track as CanonicalTrack;
use Kompakt\B3d\Canonical\Converter\Details\ConverterRunner;
use Kompakt\B3d\Canonical\Converter\Details\Product as CanonicalProductConverter;
use Kompakt\B3d\Canonical\Converter\Details\Subscriber\XmlSerializer as XmlSerializerSubscriber;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\CollectionRunner\EventNames;
use Kompakt\CollectionRunner\Runner as CollectionRunner;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();
$eventNames = new EventNames();
$collectionRunner = new CollectionRunner($dispatcher, $eventNames);

$canonicalProductConverter = new CanonicalProductConverter(
    new CanonicalProduct(),
    new CanonicalTrack(),
    new CanonicalPrice()
);

$canonicalProductXmlSerializer = new CanonicalProductXmlSerializer(
    new CanonicalProductDomBuilder(),
    new Writer(),
    'path/to/xml/output/dir'
);

$serializerSubscriber = new XmlSerializerSubscriber(
    $dispatcher,
    $eventNames,
    $canonicalProductXmlSerializer
);

$converterRunner = new ConverterRunner(
    $collectionRunner,
    $graphLoader,
    $canonicalProductConverter
);

$serializerSubscriber->activate();
$converterRunner->load();
$converterRunner->run();
```

Of course, you don't necessarily need to serialize the canonical products. You could omit `XmlSerializerSubscriber` and write your own event listener to directly save the data into a database

## Populating Canonical Product Repository from serialized XML

```php
use Kompakt\B3d\Canonical\Dom\Product\Mapper as DomProductMapper;
use Kompakt\B3d\Canonical\Entity\Price;
use Kompakt\B3d\Canonical\Entity\Product;
use Kompakt\B3d\Canonical\Entity\Track;
use Kompakt\B3d\Canonical\Populator\Xml\Subscriber\Product as Populator;
use Kompakt\B3d\Canonical\Repository\ProductRepository;
use Kompakt\B3d\Canonical\Unserializer\Xml\Product as Unserializer;
use Kompakt\B3d\Util\Dom\Loader as DomLoader;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\DirectoryRunner\Runner;
use Kompakt\DirectoryRunner\EventNames;
use Kompakt\DirectoryRunner\Subscriber\Debugger;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();
$eventNames = new EventNames();
$fileReader = new Reader();
$domLoader = new DomLoader();

$runner = new Runner(
    $dispatcher,
    $eventNames,
    $canonicalProductDirPathname
);

$price = new Price();
$product = new Product();
$track = new Track();
$domMapper = new DomProductMapper($product, $track, $price);
$repository = new ProductRepository();

$unserializer = new Unserializer(
    $fileReader,
    $domLoader,
    $domMapper
);

$populator = new Populator(
    $dispatcher,
    $eventNames,
    $unserializer,
    $repository
);

$populator->activate();
$runner->run();

foreach ($repository->getAll() as $product)
{
    echo sprintf("%s\n", $product->getReleaseTitle());

    foreach ($product->getTracks() as $track)
    {
        echo sprintf(">> %s\n", $track->getTitle());
    }
}
```

## Fetching Stock

Once you have your products in place, you can fetch stocklevels. Be aware that the API returns a maximum of 200 stock items per request:

```php
use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Stock\Endpoint as StockEndpoint;
use Kompakt\B3d\Details\Endpoint\Cache\PhpFile\Serializer as PhpFileSerializer;
use Kompakt\B3d\Util\File\Writer;
use Symfony\Component\Stopwatch\Stopwatch;

$stockEndpoint = new StockEndpoint(
    new Client(),
    '<stock-endpoint-url>',
    '<api-key>'
);

$stockEndpoint->fetch(['uuid-1', 'uuid-2']);
```

## Passing Orders To Details

```php
use GuzzleHttp\Client;
use Kompakt\B3d\Details\Endpoint\Resource\Order\Endpoint;

$orderEndpoint = new Endpoint(
    new Client(),
    '<stock-endpoint-url>',
    '<api-key>'
);

$orderData = [
    ...
];

$itemData = [
    ...
];

$orderEndpoint->create($orderData, $itemData);
```

## Working Examples

+ `cp example/config.php.dist config.php`
+ Adjust `config.php` as needed

## License

kompakt/b3d is licensed under the MIT license - see the LICENSE file for details