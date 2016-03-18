<?php

namespace Charcoal\Admin\Ui;

/**
 * The Object Container Interface.
 */
interface ObjectContainerInterface
{

    /**
     * @param string $objType The object type.
     * @return ObjectContainerInterface Chainable
     */
    public function setObjType($objType);

    /**
     * @return string
     */
    public function objType();

    /**
     * @param mixed $objId The object id, to load.
     * @return ObjectContainerInterface Chainable
     */
    public function setObjId($objId);

    /**
     * @return mixed
     */
    public function objId();

    /**
     * @return ModelInterface
     */
    public function obj();
}
