<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamMapping
 * 
 * @property int $id
 * @property int $userId
 * @property int $teamId
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Team $team
 * @property User $user
 *
 * @package App\Models
 */
class TeamMapping extends Model
{
	protected $table = 'team_mapping';

	protected $casts = [
		'userId' => 'int',
		'teamId' => 'int'
	];

	protected $fillable = [
		'userId',
		'teamId'
	];

	public function team()
	{
		return $this->belongsTo(Team::class, 'teamId');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'userId');
	}
}
