<?php
namespace KDuma\Eloquent;

use Rhumsaa\Uuid\Uuid;
use Config;
use Hashids\Hashids;


/**
 * Class Guidable
 * @package KDuma\Eloquent
 */
trait Guidable {


    /**
     * @return string
     */
    protected function makeGuid()
    {

        $guid = Uuid::uuid4()->toString();

        if($guid == $this->guid)
            return $guid;

        $rowCount = \DB::table($this->getTable())->where('guid', $guid)->count();
        if ($rowCount > 0) {
            return $this->makeGuid();
        } else {
            return $guid;
        }
    }

    /**
     *
     */
    public function newGuid(){
        $this->guid = $this->makeGuid();
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function save(array $options=[]){
        if($this->guid == '')
            $this->newGuid();
        return parent::save($options);
    }


    /**
     * @param $query
     * @param $guid
     * @return mixed
     */
    public function scopeWhereGuid($query, $guid)
    {
        return $query->where($this->getTable().'.guid', $guid);
    }


}
