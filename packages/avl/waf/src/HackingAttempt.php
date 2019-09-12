<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 20/09/18
 * Time: 11:44
 */

namespace AVL\WAF;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HackingAttempt extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'hacking_attempts';

    /**
     * @var array
     */
    protected $fillable = [
        'ip',
        'description',
        'payload',
        'url',
        'user_id'
    ];

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string                                $ip
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereIp(Builder $builder, $ip = '')
    {
        $builder->where('ip', '=', $ip);

        return $builder;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \App\User
     */
    public function getUser()
    {
        return $this->user;
    }
}