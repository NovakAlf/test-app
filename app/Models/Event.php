<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
  use HasFactory;

  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'text',
  ];

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  protected static function booted()
  {
    static::creating(function ($event) {
      $event->author = auth()->user()->id;
    });

    static::created(function (Event $event) {
      $event->users()->attach(auth()->user()->id);
    });
  }
}
