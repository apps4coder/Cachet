<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Group extends Eloquent
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
