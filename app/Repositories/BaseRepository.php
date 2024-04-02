<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository extends \Prettus\Repository\Eloquent\BaseRepository
{

    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    public function search($keyword = null, $keywordColumns = [], $search = [])
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            $query->where($search);
        }

        if (count($keywordColumns)) {
            foreach ($keywordColumns as $key => $columnName) {
                if (in_array($columnName, $this->getFieldsSearchable())) {

                    $query->where(function ($q) use ($key, $columnName, $keyword) {
                        if ($key == 0) {
                            $q->where($columnName, 'like', '%' . $keyword . '%');
                        } else {
                            $q->orWhere($columnName, 'like', '%' . $keyword . '%');
                        }
                        return $q;
                    });
                }
            }
        }

        return $query;
    }

}
