<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Arduinos
 *
 * @property int $id
 * @property string $arduino_name
 * @property string $arduino_ip
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos query()
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereArduinoIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereArduinoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Arduinos whereUpdatedAt($value)
 */
	class Arduinos extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ButtonLogs
 *
 * @property int $id
 * @property string $arduino_name
 * @property string $button_status
 * @property string $status_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs query()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereArduinoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereButtonStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereStatusValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonLogs whereUpdatedAt($value)
 */
	class ButtonLogs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ButtonStatuses
 *
 * @property int $id
 * @property string $button_pin
 * @property string $button_val
 * @property string $action_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses query()
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereActionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereButtonPin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereButtonVal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ButtonStatuses whereUpdatedAt($value)
 */
	class ButtonStatuses extends \Eloquent {}
}

