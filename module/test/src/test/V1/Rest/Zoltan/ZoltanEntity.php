<?php
namespace test\V1\Rest\Zoltan;

class ZoltanEntity
{
    protected $id;
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
