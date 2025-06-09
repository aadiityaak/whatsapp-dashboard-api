<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappSession extends Model
{
  protected $fillable = ['session_id', 'status', 'last_connected_at'];
}
