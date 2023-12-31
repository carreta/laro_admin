<?php

namespace App\Models\crud\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class DocumentType extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'document_types';

    protected $fillable = [
        'hacienda_id',
        'name',
    ];
}
