<?php

namespace App\Representation;

use JMS\Serializer\Annotation\Type;

use Pagerfanta\Pagerfanta;

class Movings 
{
    /**
     * @Type("array<App\Entity\Moving>")
     */

    public $data;
    public $meta;

    public function __construct(Pagerfanta $data)
    {
        $this->data = $data;

        $this->addMeta('limit', $data->getMaxPerPage());
        $this->addMeta('current_items', count($data->getCurrentPageResults()));
        $this->addMeta('total_items', $data->getNbResults());
        $this->addMeta('offset', $data->getCurrentPageOffsetStart());
    }

    public function addMeta($name, $value)
    {
        if(isset($this->meta[$name])) {
            throw new \LogicException(sprintf('This metat already exists. you are trying override this meta,
            use the setMeta method instead for the %s meta.', $name));
        }
         $this->setMeta($name, $value);
    }

    public function setMeta($name, $value)
    {
        $this->meta[$name] = $value;
    }
}