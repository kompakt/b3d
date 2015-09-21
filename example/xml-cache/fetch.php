<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

require sprintf('%s/bootstrap.php', dirname(__DIR__));

use Kompakt\B3d\Details\Dom\Artist\Builder as ArtistDomBuilder;
use Kompakt\B3d\Details\Dom\Label\Builder as LabelDomBuilder;
use Kompakt\B3d\Details\Dom\Product\Builder as ProductDomBuilder;
use Kompakt\B3d\Details\Dom\ProductTrack\Builder as ProductTrackDomBuilder;
use Kompakt\B3d\Details\Dom\Release\Builder as ReleaseDomBuilder;
use Kompakt\B3d\Details\Dom\Track\Builder as TrackDomBuilder;
use Kompakt\B3d\Details\Entity\Artist;
use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Entity\Product;
use Kompakt\B3d\Details\Entity\ProductTrack;
use Kompakt\B3d\Details\Entity\Release;
use Kompakt\B3d\Details\Entity\Track;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Endpoint as ArtistEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Endpoint as LabelEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Endpoint as ProductEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Endpoint as ProductTrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Endpoint as ReleaseEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Endpoint as TrackEndpoint;
use Kompakt\B3d\Details\Endpoint\Resource\Artist\Mapper as ArtistMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Label\Mapper as LabelMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Product\Mapper as ProductMapper;
use Kompakt\B3d\Details\Endpoint\Resource\ProductTrack\Mapper as ProductTrackMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Release\Mapper as ReleaseMapper;
use Kompakt\B3d\Details\Endpoint\Resource\Track\Mapper as TrackMapper;
use Kompakt\B3d\Details\Endpoint\Cache\Runner as CacheRunner;
use Kompakt\B3d\Details\Endpoint\Cache\XmlFiles\Serializer as XmlFilesSerializer;
use Kompakt\B3d\Util\File\Writer;
use Kompakt\B3d\Util\Timer\Timer;

$tmpDir = getTmpDir();
$artistTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/artists');
$labelTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/labels');
$productTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/products');
$productTrackTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/product-tracks');
$releaseTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/releases');
$trackTmpDirPathname = $tmpDir->replaceSubDir('xml-cache/tracks');

// endpoints
$artistEndpoint = new ArtistEndpoint($client);
$labelEndpoint = new LabelEndpoint($client);
$productEndpoint = new ProductEndpoint($client);
$productTrackEndpoint = new ProductTrackEndpoint($client);
$releaseEndpoint = new ReleaseEndpoint($client);
$trackEndpoint = new TrackEndpoint($client);

// serializers
$artistXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new ArtistMapper(new Artist()),
    new ArtistDomBuilder(),
    $artistTmpDirPathname
);

$labelXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new LabelMapper(new Label()),
    new LabelDomBuilder(),
    $labelTmpDirPathname
);

$productXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new ProductMapper(new Product()),
    new ProductDomBuilder(),
    $productTmpDirPathname
);

$productTrackXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new ProductTrackMapper(new ProductTrack()),
    new ProductTrackDomBuilder(),
    $productTrackTmpDirPathname
);

$releaseXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new ReleaseMapper(new Release()),
    new ReleaseDomBuilder(),
    $releaseTmpDirPathname
);

$trackXmlFilesSerializer = new XmlFilesSerializer(
    new Writer(),
    new TrackMapper(new Track()),
    new TrackDomBuilder(),
    $trackTmpDirPathname
);

// runner
$cacheRunner = new CacheRunner();

$cacheRunner->add(
    new ArtistEndpoint($client),
    $artistXmlFilesSerializer
);

$cacheRunner->add(
    new LabelEndpoint($client),
    $labelXmlFilesSerializer
);

$cacheRunner->add(
    new ProductEndpoint($client),
    $productXmlFilesSerializer
);

$cacheRunner->add(
    new ProductTrackEndpoint($client),
    $productTrackXmlFilesSerializer
);

$cacheRunner->add(
    new ReleaseEndpoint($client),
    $releaseXmlFilesSerializer
);

$cacheRunner->add(
    new TrackEndpoint($client),
    $trackXmlFilesSerializer
);

// run
$timer = new Timer();
$timer->start();
$cacheRunner->run();
$timer->stop();

echo sprintf("Time: %s Sec\n", $timer->getSeconds(0));
echo sprintf("Memory: %s Mb\n", round(memory_get_usage() / 1024 / 1024, 0));