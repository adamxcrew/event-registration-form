<?php

namespace App\Traits;

trait Filterable
{
    /**
     * Boot the Filterable trait for the model.
     *
     * @return void
     */

    public function scopeFilter($query)
    {
        $model = $query->getModel();
        $filterable = $model->filterable;
        if (!$filterable) {
            array_push($model->fillable, 'created_at', 'updated_at');
            $filterable = $model->fillable;
        }

        foreach (request()->all() as $key => $value) {
            if (in_array($key, $filterable) && $value) {
                $query = $query->where($key, $value);
            }
        }

        return $query;
    }
}
