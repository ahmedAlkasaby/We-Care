<?php

namespace App\Traits;

use App\Models\Log;

trait LogTrait{
    public static function bootLogTrait()
    {
        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    public function logActivity($action)
    {
        Log::create([
            'name' => class_basename($this),
            'description' => __("site.activity_log", [
                'action' => __("site.$action"),
                'model' => class_basename($this),
                'user' => auth()->user()->name
            ]),
            'model_id' => $this->id,
            'model_type' => get_class($this),
            'user_id' => auth()->id() ?? null,
            'action' => $action,
            'properties' => $action === 'updated' ? [
                'old' => $this->getOriginal(),
                'new' => $this->getChanges(),
            ] : null,
        ]);
    }
}
