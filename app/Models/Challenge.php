<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Challenge",
 *      required={"challenger_id", "challenged_id", "week_id", "winner_id", "challenged_at", "challenger_rank", "challenged_rank", "video"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="challenger_id",
 *          description="challenger_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="challenged_id",
 *          description="challenged_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="week_id",
 *          description="week_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="winner_id",
 *          description="winner_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="challenged_at",
 *          description="challenged_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="challenger_rank",
 *          description="challenger_rank",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="challenged_rank",
 *          description="challenged_rank",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="video",
 *          description="video",
 *          type="string"
 *      )
 * )
 */
class Challenge extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'challenges';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'challenger_id',
        'challenged_id',
        'week_id',
        'winner_id',
        'challenged_at',
        'challenger_rank',
        'challenged_rank',
        'video'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'challenger_id' => 'integer',
        'challenged_id' => 'integer',
        'week_id' => 'integer',
        'winner_id' => 'integer',
        'challenged_at' => 'datetime',
        'challenger_rank' => 'integer',
        'challenged_rank' => 'integer',
        'video' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'challenger_id' => 'required',
        'challenged_id' => 'required',
        'week_id' => 'required',
        'winner_id' => 'required',
        'challenged_at' => 'required',
        'challenger_rank' => 'required',
        'challenged_rank' => 'required',
        'video' => 'required|string|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function challenged()
    {
        return $this->belongsTo(\App\Models\Flexer::class, 'challenged_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function challenger()
    {
        return $this->belongsTo(\App\Models\Flexer::class, 'challenger_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deletedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function week()
    {
        return $this->belongsTo(\App\Models\Week::class, 'week_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function winner()
    {
        return $this->belongsTo(\App\Models\Flexer::class, 'winner_id');
    }
}
