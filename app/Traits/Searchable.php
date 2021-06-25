<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Searchable
{
    /**
     * Boot the Searchable trait for the model.
     *
     * @return void
     */

    public function scopeSearch($query)
    {
        $keyword = request('q');
        if ($keyword) {
            $model = $query->getModel();
            $searchable = $model->searchable;

            $local = Arr::where($searchable, function ($value, $key) {
                return is_numeric($key);
            });

            foreach ($local ?? [] as $key => $field) {
                $where = $key == 0 ? 'where' : 'orWHere';
                $query = $query->{$where}($field, 'like', "%$keyword%");
            }

            $relations = Arr::where($searchable, function ($value, $key) {
                return is_string($key);
            });

            foreach ($relations ?? [] as $key => $field) {
                $fields = Arr::wrap($field);
                $whereHas = empty($local) && $key == 0 ? 'whereHas' : 'orWhereHas';
                $query = $query->{$whereHas}($key, function ($query) use ($fields, $keyword) {
                    foreach ($fields as $key => $field) {
                        $where = $key == 0 ? 'where' : 'orWHere';
                        $query->{$where}($field, 'like', "%$keyword%");
                    }
                });
            }

            return $query;
        }
    }
}
