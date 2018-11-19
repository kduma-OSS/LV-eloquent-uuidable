<?php

namespace KDuma\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class Uuidable.
 */
trait Uuidable
{
    /**
     * Boot the trait.
     */
    protected static function bootUuidable()
    {
        static::creating(function (Model $model) {
            $model->generateUuidOnCreateOrUpdate();
        });

        static::updating(function (Model $model) {
            $model->generateUuidOnCreateOrUpdate();
        });
    }

    /**
     * @throws \Exception
     */
    public function regenerateUuid()
    {
        $this->{$this->getUuidField()} = $this->uuidGenerate();
    }

    /**
     * Get the UUID field name associated with the model.
     *
     * @return string
     */
    public function getUuidField()
    {
        if (!isset($this->uuid_field))
            return 'uuid';

        return $this->uuid_field;
    }

    /**
     * @param $query
     * @param $guid
     * @return mixed
     */
    public function scopeWhereUuid($query, $guid)
    {
        return $query->where($this->getTable().'.'.$this->getUuidField(), $guid);
    }



    /**
     * @return string
     * @throws \Exception
     */
    protected function uuidGenerate()
    {
        $guid = Uuid::uuid4()->toString();

        $rowCount = \DB::table($this->getTable())->where($this->getUuidField(), $guid)->count();

        return $rowCount > 0 ? $this->uuidGenerate() : $guid;
    }

    /**
     * @throws \Exception
     */
    protected function generateUuidOnCreateOrUpdate()
    {
        if($this->{$this->getUuidField()} == null)
            $this->regenerateUuid();
    }



    /**
     * @deprecated
     * @param $query
     * @param $guid
     * @return mixed
     */
    public function scopeWhereGuid($query, $guid)
    {
        return $this->scopeWhereUuid($query, $guid);
    }

    /**
     * @deprecated
     * @throws \Exception
     */
    public function newGuid()
    {
        $this->regenerateUuid();
    }
}
