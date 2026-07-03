<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function record(string $action, string $description): void
    {
        static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'description' => $description,
        ]);
    }

    /**
     * Build a human-readable "field: old → new" summary from an update.
     *
     * @param array $original Attribute values before the update (Model::getOriginal()).
     * @param array $changes Attribute values that actually changed (Model::getChanges()).
     * @param array $labels Map of attribute key => readable label; keys not listed here are ignored.
     * @param array $sensitive Attribute keys whose values should not be revealed (e.g. password, photo).
     */
    public static function describeChanges(array $original, array $changes, array $labels, array $sensitive = []): string
    {
        $parts = [];

        foreach ($changes as $key => $newValue) {
            if ($key === 'updated_at' || !isset($labels[$key])) {
                continue;
            }

            $label = $labels[$key];

            if (in_array($key, $sensitive, true)) {
                $parts[] = "{$label} diubah";
                continue;
            }

            $oldValue = $original[$key] ?? '-';

            foreach ([&$oldValue, &$newValue] as &$value) {
                if ($value instanceof \DateTimeInterface) {
                    $value = $value->format('d-m-Y');
                }
            }
            unset($value);

            $parts[] = "{$label}: \"{$oldValue}\" → \"{$newValue}\"";
        }

        return $parts ? implode(', ', $parts) : 'tidak ada perubahan data';
    }
}
