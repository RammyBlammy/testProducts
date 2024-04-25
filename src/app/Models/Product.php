<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class Product extends Model
{
    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'product';


    public function customFields()
    {
        return $this->hasMany(CustomFields::class);
    }
}
