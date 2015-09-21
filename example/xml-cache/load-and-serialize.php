<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Adapter\EventDispatcher\Symfony\EventDispatcher;
use Kompakt\B3d\Canonical\Dom\Product\Builder as CanonicalProductDomBuilder;
use Kompakt\B3d\Canonical\Entity\Product as CanonicalProduct;
use Kompakt\B3d\Canonical\Entity\Track as CanonicalTrack;
use Kompakt\B3d\Canonical\Converter\Details\Product as CanonicalProductConverter;
use Kompakt\B3d\Canonical\Converter\Details\ConverterXmlSerializer as CanonicalProductConverterXmlSerializer;
use Kompakt\B3d\Canonical\Serializer\Xml\Product as CanonicalProductXmlSerializer;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Dom\Artist\Mapper as ArtistDomMapper;
use Kompakt\B3d\Details\Dom\Label\Mapper as LabelDomMapper;
use Kompakt\B3d\Details\Dom\Product\Mapper as ProductDomMapper;
use Kompakt\B3d\Details\Dom\ProductTrack\Mapper as ProductTrackDomMapper;
use Kompakt\B3d\Details\Dom\Release\Mapper as ReleaseDomMapper;
use Kompakt\B3d\Details\Dom\Track\Mapper as TrackDomMapper;
use Kompakt\B3d\Details\Graph\Loader as GraphLoader;
use Kompakt\B3d\Details\Populator\Cache\XmlFiles\Populator;
use Kompakt\B3d\Details\Populator\Cache\XmlFiles\Runner as PopulatorRunner;
use Kompakt\B3d\Details\Repository\ArtistRepository;
use Kompakt\B3d\Details\Repository\LabelRepository;
use Kompakt\B3d\Details\Repository\ProductRepository;
use Kompakt\B3d\Details\Repository\ProductTrackRepository;
use Kompakt\B3d\Details\Repository\ReleaseRepository;
use Kompakt\B3d\Details\Repository\TrackRepository;
use Kompakt\B3d\DropDir\DropDir;
use Kompakt\B3d\DropDir\EventNames;
use Kompakt\B3d\Util\Dom\Loader as DomLoader;
use Kompakt\B3d\Util\File\Reader;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;
use Symfony\Component\EventDispatcher\EventDispatcher as SymfonyEventDispatcher;

// config
$tmpDir = getTmpDir();
$canonicalProductTmpDirPathname = $tmpDir->replaceSubDir('canonical');

$artistDirPathname = sprintf('%s/xml-cache/artists', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$labelDirPathname = sprintf('%s/xml-cache/labels', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$productDirPathname = sprintf('%s/xml-cache/products', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$productTrackDirPathname = sprintf('%s/xml-cache/product-tracks', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$releaseDirPathname = sprintf('%s/xml-cache/releases', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);
$trackDirPathname = sprintf('%s/xml-cache/tracks', EXAMPLE_KOMPAKT_B3D_TEMP_DIR);

// general
$dispatcher = new EventDispatcher(new SymfonyEventDispatcher());
$eventNames = new EventNames();
$fileReader = new Reader();
$domLoader = new DomLoader();

// entities
$artist = new Artist();
$label = new Label();
$product = new Product();
$productTrack = new ProductTrack();
$release = new Release();
$track = new Track();

// repos
$artistRepository = new ArtistRepository();
$labelRepository = new LabelRepository();
$productRepository = new ProductRepository();
$productTrackRepository = new ProductTrackRepository();
$releaseRepository = new ReleaseRepository();
$trackRepository = new TrackRepository();

// repository populators
$artistPopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new ArtistDomMapper($artist),
    $artistRepository
);

$labelPopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new LabelDomMapper($label),
    $labelRepository
);

$productPopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new ProductDomMapper($product),
    $productRepository
);

$productTrackPopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new ProductTrackDomMapper($productTrack),
    $productTrackRepository
);

$releasePopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new ReleaseDomMapper($release),
    $releaseRepository
);

$trackPopulator = new Populator(
    $eventNames,
    $fileReader,
    $domLoader,
    new TrackDomMapper($track),
    $trackRepository
);

// populator runners
$artistPopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $artistPopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($artistDirPathname)
);

$labelPopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $labelPopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($labelDirPathname)
);

$productPopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $productPopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($productDirPathname)
);

$productTrackPopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $productTrackPopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($productTrackDirPathname)
);

$releasePopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $releasePopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($releaseDirPathname)
);

$trackPopulatorRunner = new PopulatorRunner(
    $dispatcher,
    $trackPopulator,
    new DropDir($dispatcher, $eventNames),
    new \DirectoryIterator($trackDirPathname)
);

// graph loader
$graphLoader = new GraphLoader(
    $artistRepository,
    $artistPopulatorRunner,
    $labelRepository,
    $labelPopulatorRunner,
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
    new CanonicalTrack()
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
echo sprintf("ProductTracks: %s\n", count($productTrackRepository->getAll()));
echo sprintf("Releases: %s\n", count($releaseRepository->getAll()));
echo sprintf("Tracks: %s\n", count($trackRepository->getAll()));
echo sprintf("Missing artists: %s\n", $graphLoader->getMissingArtists());
echo sprintf("Missing labels: %s\n", $graphLoader->getMissingLabels());
echo sprintf("Missing tracks: %s\n", $graphLoader->getMissingTracks());
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));
echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));