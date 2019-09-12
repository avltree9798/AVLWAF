<?php

namespace AVL\WAF;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blacklist extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'blacklists';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
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
}
