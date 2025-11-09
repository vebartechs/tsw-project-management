<?php

namespace App\Models\Project;

use App\Models\Project\ProjectDay;
use App\Models\Project\ProjectDeliverable;
use App\Models\Project\ProjectComplimentary;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'customer_id',
        'title',
        'cost',
        'days',
    ];




    // relationship
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function projectdays(): HasMany
    {
        return $this->hasMany(ProjectDay::class);
    }
    
    public function projectdeliverables(): HasMany
    {
        return $this->hasMany(ProjectDeliverable::class);
    }

    public function projectcomplimentary(): HasOne
    {
        return $this->hasOne(ProjectComplimentary::class);
    }
    



    
}
