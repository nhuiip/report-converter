<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Holiday
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Holiday extends Model
{
	use SoftDeletes;
	protected $table = 'holidays';

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'date'
	];
}
