<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class History
 *
 * @property int $id
 * @property int $userId
 * @property int $reference
 * @property int $referenceType
 * @property int $referenceParent
 * @property int $lavel
 * @property Carbon $created
 * @property int|null $manday
 * @property int|null $points
 * @property Carbon|null $startDate
 * @property Carbon|null $deliveryDate
 * @property Carbon|null $workDay
 * @property int|null $tracking
 * @property float|null $totalPoints
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property User $user
 * @property Collection|HistoryLog[] $history_logs
 *
 * @package App\Models
 */
class History extends Model
{
    use SoftDeletes;
    protected $table = 'histories';

    protected $casts = [
        'userId' => 'int',
        'reference' => 'int',
        'referenceType' => 'int',
        'referenceParent' => 'int',
        'lavel' => 'int',
        'manday' => 'int',
        'points' => 'int',
        'tracking' => 'int',
        'totalPoints' => 'float'
    ];

    protected $dates = [
        'created',
        'startDate',
        'deliveryDate',
        'workDay'
    ];

    protected $fillable = [
        'userId',
        'reference',
        'referenceType',
        'referenceParent',
        'lavel',
        'created',
        'manday',
        'points',
        'startDate',
        'deliveryDate',
        'workDay',
        'tracking',
        'totalPoints'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function history_logs()
    {
        return $this->hasMany(HistoryLog::class, 'historyId');
    }

    const type = [
        'task' => ['value' => 1, 'desc' => 'Task'],
        'bug' => ['value' => 2, 'desc' => 'Bug']
    ];
    const lavel = [
        'high' => ['value' => 1, 'desc' => 'High'],
        'medium' => ['value' => 2, 'desc' => 'Medium'],
        'low' => ['value' => 3, 'desc' => 'Low'],
        'lowest' => ['value' => 4, 'desc' => 'Lowest']
    ];
    const tracking = [
        'normal' => ['value' => 1, 'desc' => 'Normal'],
        'fast' => ['value' => 2, 'desc' => 'Fast'],
        'late' => ['value' => 3, 'desc' => 'Late'],
    ];

    static function getTypeDesc($value)
    {
        switch ($value) {
            case static::type['task']['value']:
                $result = static::type['task']['desc'];
                break;
            case static::type['bug']['value']:
                $result = static::type['bug']['desc'];
                break;
            default:
                $result = "";
                break;
        }

        return $result;
    }
    static function getLavelDesc($value)
    {
        switch ($value) {
            case static::lavel['high']['value']:
                $result = static::lavel['high']['desc'];
                break;
            case static::lavel['medium']['value']:
                $result = static::lavel['medium']['desc'];
                break;
            case static::lavel['low']['value']:
                $result = static::lavel['low']['desc'];
                break;
            case static::lavel['lowest']['value']:
                $result = static::lavel['lowest']['desc'];
                break;
            default:
                $result = "";
                break;
        }

        return $result;
    }
    static function getTrackingDesc($value)
    {
        switch ($value) {
            case static::lavel['normal']['value']:
                $result = static::lavel['normal']['desc'];
                break;
            case static::lavel['fast']['value']:
                $result = static::lavel['fast']['desc'];
                break;
            case static::lavel['late']['value']:
                $result = static::lavel['late']['desc'];
                break;
            default:
                $result = "";
                break;
        }

        return $result;
    }
}
