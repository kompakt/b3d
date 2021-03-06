<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Canonical\Dom\Product\Builder as CanonicalProductDomBuilder;
use Kompakt\B3d\Canonical\Entity\Price as CanonicalPrice;
use Kompakt\B3d\Canonical\Entity\Product as CanonicalProduct;
use Kompakt\B3d\Canonical\Entity\Track as CanonicalTrack;
use Kompakt\B3d\Canonical\Converter\Details\ConverterRunner;
use Kompakt\B3d\Canonical\Converter\Details\Product as CanonicalProductConverter;
use Kompakt\B3d\Canonical\Converter\Details\Subscriber\XmlSerializer as XmlSerializerSubscriber;
use Kompakt\B3d\Canonical\Serializer\Xml\Product as CanonicalProductXmlSerializer;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Entity\Price;
use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Graph\Loader as GraphLoader;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Details\Repository\LabelRepository;
use Kompakt\B3d\Details\Repository\PriceRepository;
use Kompakt\B3d\Details\Repository\ProductRepository;
use Kompakt\B3d\Details\Repository\ProductTrackRepository;
use Kompakt\B3d\Details\Repository\ReleaseRepository;
use Kompakt\B3d\Details\Repository\TrackRepository;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Mapper as ArtistMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Mapper as LabelMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Mapper as PriceMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Mapper as ProductMapper;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Mapper as ProductTrackMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Mapper as ReleaseMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Mapper as TrackMapper;
use Kompakt\B3d\Details\Populator\Cache\PhpFile\Populator;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\CollectionRunner\EventNames;
use Kompakt\CollectionRunner\Runner as CollectionRunner;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Stopwatch\Stopwatch;

// config
$tmpDir = getTmpDir();
$canonicalProductTmpDirPathname = $tmpDir->replaceSubDir('php-cache-product-xml');

$artistFilePathname = sprintf('%s/php-cache-product-data/artists.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$labelFilePathname = sprintf('%s/php-cache-product-data/labels.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$priceFilePathname = sprintf('%s/php-cache-product-data/prices.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$productFilePathname = sprintf('%s/php-cache-product-data/products.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$productTrackFilePathname = sprintf('%s/php-cache-product-data/product-tracks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$releaseFilePathname = sprintf('%s/php-cache-product-data/releases.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$trackFilePathname = sprintf('%s/php-cache-product-data/tracks.data', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$fileReader = new Reader();
$dispatcher = new EventDispatcher();
$eventNames = new EventNames();
$collectionRunner = new CollectionRunner($dispatcher, $eventNames);

// entities
$artist = new Artist();
$label = new Label();
$price = new Price();
$product = new Product();
$productTrack = new ProductTrack();
$release = new Release();
$track = new Track();

// data-mappers
$artistMapper = new ArtistMapper($artist);
$labelMapper = new LabelMapper($label);
$priceMapper = new PriceMapper($price);
$productMapper = new ProductMapper($product);
$productTrackMapper = new ProductTrackMapper($productTrack);
$releaseMapper = new ReleaseMapper($release);
$trackMapper = new TrackMapper($track);

// repos
$artistRepository = new ArtistRepository();
$labelRepository = new LabelRepository();
$priceRepository = new PriceRepository();
$productRepository = new ProductRepository();
$productTrackRepository = new ProductTrackRepository();
$releaseRepository = new ReleaseRepository();
$trackRepository = new TrackRepository();

// populator runners
$artistPopulator = new Populator(
    $artistMapper,
    $artistRepository,
    $fileReader,
    $artistFilePathname
);

$labelPopulator = new Populator(
    $labelMapper,
    $labelRepository,
    $fileReader,
    $labelFilePathname
);

$pricePopulator = new Populator(
    $priceMapper,
    $priceRepository,
    $fileReader,
    $priceFilePathname
);

$productPopulator = new Populator(
    $productMapper,
    $productRepository,
    $fileReader,
    $productFilePathname
);

$productTrackPopulator = new Populator(
    $productTrackMapper,
    $productTrackRepository,
    $fileReader,
    $productTrackFilePathname
);

$releasePopulator = new Populator(
    $releaseMapper,
    $releaseRepository,
    $fileReader,
    $releaseFilePathname
);

$trackPopulator = new Populator(
    $trackMapper,
    $trackRepository,
    $fileReader,
    $trackFilePathname
);

// graphloader
$graphLoader = new GraphLoader(
    $artistPopulator,
    $labelPopulator,
    $pricePopulator,
    $productPopulator,
    $productTrackPopulator,
    $releasePopulator,
    $trackPopulator
);

// converter
$canonicalProductConverter = new CanonicalProductConverter(
    new CanonicalProduct(),
    new CanonicalTrack(),
    new CanonicalPrice()
);

// serializer
$canonicalProductXmlSerializer = new CanonicalProductXmlSerializer(
    new CanonicalProductDomBuilder(),
    new Writer(),
    $canonicalProductTmpDirPathname
);

$serializerSubscriber = new XmlSerializerSubscriber(
    $dispatcher,
    $eventNames,
    $canonicalProductXmlSerializer
);

// runner
$converterRunner = new ConverterRunner(
    $collectionRunner,
    $graphLoader,
    $canonicalProductConverter
);

// run
$stopwatch = new Stopwatch();
$stopwatch->start('b3d', 'b3d');
$serializerSubscriber->activate();
$converterRunner->load();
$converterRunner->run();
$event = $stopwatch->stop('b3d');

echo sprintf("%s\n", $event);
echo sprintf("Products: %s\n", count($productRepository->getAll()));
echo sprintf("Prices: %s\n", count($priceRepository->getAll()));
echo sprintf("ProductTracks: %s\n", count($productTrackRepository->getAll()));
echo sprintf("Releases: %s\n", count($releaseRepository->getAll()));
echo sprintf("Tracks: %s\n", count($trackRepository->getAll()));
echo sprintf("Missing artists: %s\n", $graphLoader->getMissingArtists());
echo sprintf("Missing labels: %s\n", $graphLoader->getMissingLabels());
echo sprintf("Missing tracks: %s\n", $graphLoader->getMissingTracks());