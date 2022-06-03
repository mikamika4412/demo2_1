<?php

namespace AdvancedCoder\ProductTypes\Api\Data;

interface ProductTypesInterface
{
    const ID = 'entity_id';
    const TYPE = 'type';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void;

    /**
     * @return mixed|null
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id);
}
