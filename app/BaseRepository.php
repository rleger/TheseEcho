<?php

namespace These;

/**
 * Class BaseRepository.
 */
abstract class BaseRepository
{
    /**
     * Entity.
     *
     * @var
     */
    protected $entity;

    /**
     * Return all records for an entity.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->entity->all();
    }

    /**
     * Lists fields.
     *
     * @return array
     */
    public function lists()
    {
        if (func_num_args() > 1) {
            return $this->entity->lists(func_get_arg(0), func_get_arg(1))->all();
        }

        return $this->entity->lists(func_get_arg(0))->all();
    }

    /**
     * Return number of records for an entity.
     *
     * @return int
     */
    public function count()
    {
        return $this->entity->count();
    }

    /**
     * Find records.
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Return entire collection with paginated results.
     *
     * @param       $nb_page
     * @param array $with
     *
     * @return
     */
    public function Paginate($nb_page, $with = [])
    {
        if ($with) {
            return $this->entity->with(implode("','", $with))->Paginate($nb_page);
        }

        return $this->entity->Paginate($nb_page);
    }
}
