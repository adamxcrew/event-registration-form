<?php

namespace App\Traits;

trait Orderable
{
    /**
     * Boot the Orderable trait for the model.
     *
     * @return void
     */

    public function scopeOrder($query, $orderBy = null, $sortBy = null)
    {
        $model = $query->getModel();
        $orderable = $model->orderable;
        if (!$orderable) {
            array_push($model->fillable, 'created_at', 'updated_at');
            $orderable = $model->fillable;
        }
        $order = request()->input('order') ?? ($orderBy ?? $model->primaryKey);
        $sort = request()->input('sort') ?? ($sortBy ?? 'desc');

        request()->request->add([
            'order' => $order,
            'sort' => $sort
        ]);

        if (in_array($order, $orderable)) {
            return $query->orderBy($order, $sort);
        }
    }
}
