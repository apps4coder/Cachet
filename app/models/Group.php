<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Group extends Model
{
    use ValidatingTrait;
    use SoftDeletingTrait;

    protected $rules = [
        'name' => 'required',
    ];

    protected $fillable = ['name'];

    /**
     * A group can have many components.
     *
     * @return \Illuminate\Database\Eloquent\Relations
     */
    public function components()
    {
        return $this->hasMany('Component', 'id', 'group_id');
    }
}
