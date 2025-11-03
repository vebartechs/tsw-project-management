<?php

namespace App\Models\Employee;

use App\Models\Other\IdProof;
use App\Models\Other\JobType;
use App\Models\Other\BloodGroup;
use App\Models\Other\Profession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
   use  SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'alt_phone',
        'email',
        'address',
        'gender',
        'id_proof_id',
        'id_proof_number',
        'profession_id',
        'job_type_id',
        'date_of_joining',
        'blood_group_id',
        'pay_per_day',
        'status',
    ];


    //==relations==

    public function idProof(): BelongsTo
    {
        return $this->belongsTo(IdProof::class);
    }
    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }
    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class);
    }
    public function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class);
    }

}
