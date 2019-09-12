<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 10:23
 */

namespace AVL\WAF\Http\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Rule extends Eloquent
{
    /**
     * @var string
     */
    protected $table = 'rules';

    /**
     * @var array
     */
    protected $fillable = [
        'rule',
        'description',
        'impact',
        'user_id'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'impact' => 'int'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function getImpact()
    {
        return $this->impact;
    }
}