<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Label;

use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper implements DataMapperInterface
{
    protected $labelPrototype = null;

    public function __construct(Label $labelPrototype)
    {
        $this->labelPrototype = $labelPrototype;
    }

    /**
     * @see DataMapperInterface::map()
     */
    public function map(array $data)
    {
        $label = clone $this->labelPrototype;
        $label->setId(trim($data['label_id']));
        $label->setName(trim($data['label_name']));
        $label->setCode(trim($data['label_code']));
        $label->setInfoEnglish(trim($data['label_info_english']));
        $label->setInfoSecond(trim($data['label_info_second']));
        $label->setUrl1(trim($data['url1']));
        $label->setUrl2(trim($data['url2']));
        $label->setArtwork1(trim($data['artwork1']));
        $label->setArtwork2(trim($data['artwork2']));
        $label->setDefaultCLine(trim($data['default_c_line']));
        $label->setDefaultPLine(trim($data['default_p_line']));
        $label->setIsrcBase(trim($data['isrc_base']));
        $label->setTerritoryId(trim($data['territory_id']));
        $label->setNotes(trim($data['notes']));
        return $label;
    }
}