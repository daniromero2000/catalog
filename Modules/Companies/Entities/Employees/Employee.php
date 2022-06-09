<?php

namespace Modules\Companies\Entities\Employees;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Companies\Database\factories\EmployeeFactory;
use Modules\Companies\Entities\EmployeeAddresses\EmployeeAddress;
use Modules\Companies\Entities\EmployeeCommentaries\EmployeeCommentary;
use Modules\Companies\Entities\EmployeeEmails\EmployeeEmail;
use Modules\Companies\Entities\EmployeeEmergencyContacts\EmployeeEmergencyContact;
use Modules\Companies\Entities\EmployeeEpss\EmployeeEps;
use Modules\Companies\Entities\EmployeeIdentities\EmployeeIdentity;
use Modules\Companies\Entities\EmployeePhones\EmployeePhone;
use Modules\Companies\Entities\EmployeePositions\EmployeePosition;
use Modules\Companies\Entities\EmployeeProfessions\EmployeeProfession;
use Modules\Companies\Entities\EmployeeStatusesLogs\EmployeeStatusesLog;
use Modules\Companies\Entities\Roles\Role;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\Epss\Eps;
use Modules\Generals\Entities\Genres\Genre;
use Modules\XisfoPay\Entities\XisfoServices\XisfoService;
use Nicolaslopezj\Searchable\SearchableTrait;

class Employee extends Authenticatable
{
    use Notifiable, SoftDeletes, LaratrustUserTrait;
    use SearchableTrait;
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'is_active',
        'company_id',
        'subsidiary_id',
        'employee_position_id',
        'customer_id',
        'rh',
        'bank_account',
        'admission_date',
        'is_rotative',
        'birthday',
        'customer_id',
        'signature',
        'avatar',
        'shift_id',
        'deleted_at'
    ];

    protected $hidden = [
        'remember_token',
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance',
        'is_active',
        'employee_position_id'
    ];

protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at', 'status'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'employees.name'                      => 10,
            'employees.email'                     => 5,
            'employees.last_name'                 => 5,
            'employee_identities.identity_number' => 10,
            'employee_phones.phone'               => 10,
            'employee_emails.email'               => 5
        ],
        'joins' => [
            'employee_identities' => ['employees.id', 'employee_identities.employee_id'],
            'employee_phones' => ['employees.id', 'employee_phones.employee_id'],
            'employee_emails' => ['employees.id', 'employee_emails.employee_id'],
        ]
    ];

    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }

    public function searchEmployee($term)
    {
        return self::search($term, null, true, true);
    }

    public function employeePosition(): BelongsTo
    {
        return $this->belongsTo(EmployeePosition::class)
            ->select(['id', 'position', 'is_active']);
    }

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
            ->select(['id', 'name', 'display_name',]);
    }

    public function xisfoService(): BelongsToMany
    {
        return $this->belongsToMany(XisfoService::class, 'employee_xisfo_service', 'xisfo_service_id', 'employee_id')
            ->select(['id', 'name']);
    }

    public function customerStatusesLogs(): HasMany
    {
        return $this->hasMany(CustomerStatusesLog::class)
            ->select(['id', 'customer_id', 'status', 'employee_id', 'time_passed', 'created_at']);
    }

    public function civilStatus(): BelongsTo
    {
        return $this->belongsTo(CivilStatus::class)
            ->select(['id', 'civil_status']);
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(Eps::class)
            ->select(['id', 'eps', 'is_active']);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class)
            ->select(['id', 'genre']);
    }

    public function employeeCommentaries(): HasMany
    {
        return $this->hasMany(EmployeeCommentary::class)
            ->select(['id', 'commentary', 'user', 'employee_id', 'created_at']);
    }

    public function employeeStatusesLogs(): HasMany
    {
        return $this->hasMany(EmployeeStatusesLog::class)->with(['employee'])
            ->orderBy('created_at', 'desc')
            ->select(['id', 'employee_id', 'status', 'created_at']);
    }

    public function employeeEmails(): HasMany
    {
        return $this->hasMany(EmployeeEmail::class)
            ->select(['id', 'email_type', 'email', 'employee_id', 'status', 'created_at']);
    }

    public function employeePhones(): HasMany
    {
        return $this->hasMany(EmployeePhone::class)
            ->select(['id', 'phone_type', 'phone', 'employee_id', 'status', 'created_at']);
    }

    public function employeeIdentities(): HasMany
    {
        return $this->hasMany(EmployeeIdentity::class)
            ->select([
                'id', 'identity_type_id', 'identity_number', 'expedition_date',
                'city_id', 'employee_id', 'status', 'created_at'
            ]);
    }

    public function employeeAddresses(): HasMany
    {
        return $this->hasMany(EmployeeAddress::class)->with(['city'])
            ->select([
                'id', 'housing_id', 'address', 'time_living', 'stratum_id',
                'city_id', 'employee_id', 'status', 'created_at'
            ]);
    }

    public function employeeEmergencyContact(): HasMany
    {
        return $this->hasMany(EmployeeEmergencyContact::class)
            ->select(['id', 'name', 'phone', 'employee_id', 'status', 'created_at']);
    }

    public function employeeEpss(): HasMany
    {
        return $this->hasMany(EmployeeEps::class)
            ->select(['id', 'eps_id', 'employee_id', 'status', 'created_at']);
    }

    public function employeeProfessions(): HasMany
    {
        return $this->hasMany(EmployeeProfession::class)
            ->select(['id', 'professions_list_id', 'employee_id', 'status', 'created_at']);
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class)
            ->select(['id', 'name', 'company_id', 'city_id', 'is_active']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->with('wishlist')
            ->select(['id', 'name', 'last_name', 'birthday', 'city_id', 'email', 'status']);
    }

    public function cammodels(): HasOne
    {
        return $this->hasOne(Cammodel::class)
            ->select([
                'id', 'employee_id', 'fake_age', 'nickname',
                'height', 'weight', 'breast_cup_size', 'meta', 'likes_dislikes',
                'about_me', 'private_show', 'my_rules', 'is_active'
            ]);
    }

    public function cammodel(): HasOne
    {
        return $this->hasOne(Cammodel::class)->with('cammodelStreamAccounts', 'cammodelSocialMedia')
            ->withTrashed()
            ->select([
                'id', 'employee_id', 'fake_age', 'nickname',
                'height', 'weight', 'breast_cup_size', 'meta', 'likes_dislikes',
                'about_me', 'private_show', 'my_rules', 'is_active'
            ]);
    }

    public function cammodelId(): HasOne
    {
        return $this->hasOne(Cammodel::class)
            ->with('cammodelStreamAccounts')
            ->select(['id', 'employee_id']);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
}
