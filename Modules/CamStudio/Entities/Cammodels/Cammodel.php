<?php

namespace Modules\CamStudio\Entities\Cammodels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;
use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Modules\CamStudio\Entities\CammodelFines\CammodelFine;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\CamStudio\Entities\CammodelSocialMedias\CammodelSocialMedia;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;
use Modules\CamStudio\Entities\CammodelTippers\CammodelTipper;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Employees\Employee;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cammodel extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'cammodels';
    protected $fillable = [
        'employee_id',
        'shift_id',
        'fake_age',
        'nickname',
        'height',
        'weight',
        'slug',
        'breast_cup_size',
        'tattoos_piercings',
        'meta',
        'likes_dislikes',
        'about_me',
        'private_show',
        'my_rules',
        'cover',
        'cover_page',
        'image_tks'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'cammodels.nickname'                  => 10,
            'employees.name'                      => 10,
            'employee_identities.identity_number' => 10,
            'employee_phones.phone'               => 10,
            'employee_emails.email'               => 5
        ],
        'joins' => [
            'employees'           => ['employees.id', 'cammodels.employee_id'],
            'employee_identities' => ['cammodels.employee_id', 'employee_identities.employee_id'],
            'employee_phones'     => ['cammodels.employee_id', 'employee_phones.employee_id'],
            'employee_emails'     => ['cammodels.employee_id', 'employee_emails.employee_id'],
        ]
    ];

    public function searchCammodel($term)
    {
        return self::search($term, null, true, true);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class)->with('customer', 'employeeCommentaries', 'subsidiary')
            ->select([
                'id', 'name', 'last_name', 'email', 'birthday', 'avatar',
                'subsidiary_id', 'employee_position_id', 'is_active',
                'last_login_at',  'remember_token', 'customer_id'
            ]);
    }

    public function employeeName(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id')->with('customer')
            ->select([
                'id', 'name', 'last_name', 'subsidiary_id', 'avatar'
            ]);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CammodelCategory::class);
    }

    public function tippers(): BelongsToMany
    {
        return $this->belongsToMany(CammodelTipper::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CammodelImage::class)->select(['id', 'cammodel_id', 'src']);
    }

    public function cammodelSocialMedia(): HasMany
    {
        return $this->hasMany(CammodelSocialMedia::class)->with('socialMedia')
            ->select([
                'id', 'profile', 'user', 'cammodel_id', 'social_media_id',
                'is_active'
            ]);
    }

    public function cammodelBannedCountries(): HasMany
    {
        return $this->hasMany(CammodelBannedCountry::class)->with('country');
    }

    public function cammodelStreamAccounts(): HasMany
    {
        return $this->hasMany(CammodelStreamAccount::class)
            ->with('streaming')->whereIsActive(1)
            ->select([
                'id', 'cammodel_id', 'profile', 'streaming_id', 'user',
                'is_active', 'embed_link'
            ]);
    }

    public function cammodelInactiveStreamAccounts(): HasMany
    {
        return $this->hasMany(CammodelStreamAccount::class)
            ->with('streaming')->whereIsActive(0)
            ->select([
                'id', 'cammodel_id', 'profile', 'streaming_id',
                'user', 'is_active'
            ]);
    }

    public function cammodelStreamAccountsWithoutSkype(): HasMany
    {
        return $this->hasMany(CammodelStreamAccount::class, 'cammodel_id')
            ->with('streaming')->where('streaming_id', '!=', '20')
            ->select([
                'id', 'cammodel_id', 'profile', 'streaming_id',  'user', 'is_active'
            ]);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class)->with(['goal']);
    }

    public function cammodelFines(): HasMany
    {
        return $this->hasMany(CammodelFine::class);
    }
}
