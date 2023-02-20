<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryLog
 * 
 * @property int $id
 * @property int $historyId
 * @property int $importId
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
 * 
 * @property History $history
 * @property HistoryImport $history_import
 * @property User $user
 *
 * @package App\Models
 */
class HistoryLog extends Model
{
	protected $table = 'history_log';

	protected $casts = [
		'historyId' => 'int',
		'importId' => 'int',
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
		'historyId',
		'importId',
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

	public function history()
	{
		return $this->belongsTo(History::class, 'historyId');
	}

	public function history_import()
	{
		return $this->belongsTo(HistoryImport::class, 'importId');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'userId');
	}
}
