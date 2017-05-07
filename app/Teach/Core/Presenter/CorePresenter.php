<?php

namespace App\Teach\Core\Presenter;


use Laracasts\Presenter\Presenter;

class CorePresenter extends Presenter
{
    /**
     * @param       $attribute
     *
     * @return      mixed|string
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-05-06
     */
    public function input($attribute)
    {
        return old($attribute) ?
            old($attribute) :
            ($this->{$attribute} ?
                $this->{$attribute} :
                ''
            );
    }

    public function select($attribute, $value)
    {
        return old($attribute) ?
            ($value === old($attribute) ? 'selected' : '') :
            ($value === $this->{$attribute} ? 'selected' : '');
    }

}