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
use Kompakt\B3d\Canonical\Converter\Details\Product as CanonicalProductConverter;
use Kompakt\B3d\Canonical\Converter\Details\ConverterXmlSerializer as CanonicalProductConverterXmlSerializer;
use Kompakt\B3d\Canonical\Serializer\Xml\Product as CanonicalProductXmlSerializer;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint as ArtistEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Mapper as ArtistMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Endpoint as LabelEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Mapper as LabelMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Endpoint as PriceEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Price\Mapper as PriceMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Endpoint as ProductEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Mapper as ProductMapper;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Endpoint as ProductTrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Mapper as ProductTrackMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Endpoint as ReleaseEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Mapper as ReleaseMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Endpoint as TrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Mapper as TrackMapper;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Entity\Price;
use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Graph\Loader as GraphLoader;
use Kompakt\B3d\Details\Populator\Endpoint\PopulatorRunner;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Details\Repository\LabelRepository;
use Kompakt\B3d\Details\Repository\PriceRepository;
use Kompakt\B3d\Details\Repository\ProductRepository;
use Kompakt\B3d\Details\Repository\ProductTrackRepository;
use Kompakt\B3d\Details\Repository\ReleaseRepository;
use Kompakt\B3d\Details\Repository\TrackRepository;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;

// config
$tmpDir = getTmpDir();
$canonicalProductTmpDirPathname = $tmpDir->replaceSubDir('no-cache-xml');

// general
$fileReader = new Reader();

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

// endpoints
$artistEndpoint = new ArtistEndpoint($client);
$labelEndpoint = new LabelEndpoint($client);
$priceEndpoint = new PriceEndpoint($client);
$productEndpoint = new ProductEndpoint($client);
$productTrackEndpoint = new ProductTrackEndpoint($client);
$releaseEndpoint = new ReleaseEndpoint($client);
$trackEndpoint = new TrackEndpoint($client);

// populator runners
$artistPopulatorRunner = new PopulatorRunner(
    $artistEndpoint,
    $artistMapper,
    $artistRepository
);

$labelPopulatorRunner = new PopulatorRunner(
    $labelEndpoint,
    $labelMapper,
    $labelRepository
);

$pricePopulatorRunner = new PopulatorRunner(
    $priceEndpoint,
    $priceMapper,
    $priceRepository
);

$productPopulatorRunner = new PopulatorRunner(
    $productEndpoint,
    $productMapper,
    $productRepository
);

$productTrackPopulatorRunner = new PopulatorRunner(
    $productTrackEndpoint,
    $productTrackMapper,
    $productTrackRepository
);

$releasePopulatorRunner = new PopulatorRunner(
    $releaseEndpoint,
    $releaseMapper,
    $releaseRepository
);

$trackPopulatorRunner = new PopulatorRunner(
    $trackEndpoint,
    $trackMapper,
    $trackRepository
);

// graph loader
$graphLoader = new GraphLoader(
    $artistRepository,
    $artistPopulatorRunner,
    $labelRepository,
    $labelPopulatorRunner,
    $priceRepository,
    $pricePopulatorRunner,
    $productRepository,
    $productPopulatorRunner,
    $productTrackRepository,
    $productTrackPopulatorRunner,
    $releaseRepository,
    $releasePopulatorRunner,
    $trackRepository,
    $trackPopulatorRunner
);

// converter stuff
$canonicalProductConverter = new CanonicalProductConverter(
    new CanonicalProduct(),
    new CanonicalTrack(),
    new CanonicalPrice()
);

$canonicalProductXmlSerializer = new CanonicalProductXmlSerializer(
    new CanonicalProductDomBuilder(),
    new Writer(),
    $canonicalProductTmpDirPathname
);

$canonicalProductConverterXmlSerializer = new CanonicalProductConverterXmlSerializer(
    $graphLoader,
    $canonicalProductConverter,
    $canonicalProductXmlSerializer
);

// run
$timer = new Timer();
$timer->start();
$canonicalProductConverterXmlSerializer->run($releaseRepository);
$timer->stop();

echo sprintf("Products: %s\n", count($productRepository->getAll()));
echo sprintf("Prices: %s\n", count($priceRepository->getAll()));
echo sprintf("ProductTracks: %s\n", count($productTrackRepository->getAll()));
echo sprintf("Releases: %s\n", count($releaseRepository->getAll()));
echo sprintf("Tracks: %s\n", count($trackRepository->getAll()));
echo sprintf("Missing artists: %s\n", $graphLoader->getMissingArtists());
echo sprintf("Missing labels: %s\n", $graphLoader->getMissingLabels());
echo sprintf("Missing tracks: %s\n", $graphLoader->getMissingTracks());
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));
echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));