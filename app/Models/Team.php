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
 * Class Team
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|TeamMapping[] $team_mappings
 *
 * @package App\Models
 */
class Team extends Model
{
	use SoftDeletes;
	protected $table = 'teams';

	protected $fillable = [
		'name'
	];

	public function team_mappings()
	{
		return $this->hasMany(TeamMapping::class, 'teamId');
	}
}
