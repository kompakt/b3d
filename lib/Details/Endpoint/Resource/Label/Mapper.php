<?php

/*
 * This file is part of the kompakt/b3d package.
 *
 * (c) Christian Hoegl <chrigu@sirprize.me>
 *
 */

namespace Kompakt\B3d\Details\Endpoint\Resource\Label;

use Kompakt\B3d\Details\Endpoint\Resource\BaseMapper;
use Kompakt\B3d\Details\Entity\Label;
use Kompakt\B3d\Details\Populator\DataMapperInterface;

class Mapper extends BaseMapper implements DataMapperInterface
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
        $label->setId($this->trim($data['label_id']));
        $label->setName($this->trim($data['label_name']));
        $label->setCode($this->trim($data['label_code']));
        $label->setInfoEnglish($this->trim($data['label_info_english']));
        $label->setInfoSecond($this->trim($data['label_info_second']));
        $label->setUrl1($this->trim($data['url1']));
        $label->setUrl2($this->trim($data['url2']));
        $label->setArtwork1($this->trim($data['artwork1']));
        $label->setArtwork2($this->trim($data['artwork2']));
        $label->setDefaultCLine($this->trim($data['default_c_line']));
        $label->setDefaultPLine($this->trim($data['default_p_line']));
        $label->setIsrcBase($this->trim($data['isrc_base']));
        $label->setTerritoryId($this->trim($data['territory_id']));
        $label->setNotes($this->trim($data['notes']));
        return $label;
    }
}