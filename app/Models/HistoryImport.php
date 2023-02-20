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
 * Class HistoryImport
 * 
 * @property int $id
 * @property int $importBy
 * @property string $name
 * @property int $total
 * @property int $success
 * @property int $fail
 * @property string $rawUrl
 * @property string|null $successUrl
 * @property string|null $failUrl
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|HistoryLog[] $history_logs
 *
 * @package App\Models
 */
class HistoryImport extends Model
{
	use SoftDeletes;
	protected $table = 'history_import';

	protected $casts = [
		'importBy' => 'int',
		'total' => 'int',
		'success' => 'int',
		'fail' => 'int'
	];

	protected $fillable = [
		'importBy',
		'name',
		'total',
		'success',
		'fail',
		'rawUrl',
		'successUrl',
		'failUrl'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'importBy');
	}

	public function history_logs()
	{
		return $this->hasMany(HistoryLog::class, 'importId');
	}
}
