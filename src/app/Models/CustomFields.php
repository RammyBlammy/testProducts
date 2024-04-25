<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class CustomFields extends Model
{
    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'custom_fields';
    /**
     * Указывает, что идентификаторы модели являются автоинкрементными.
     *
     * @var bool
     */
    public $incrementing = false;
}
