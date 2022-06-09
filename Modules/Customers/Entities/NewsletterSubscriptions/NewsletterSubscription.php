<?php

namespace Modules\Customers\Entities\NewsletterSubscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class NewsletterSubscription extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'newsletter_subscriptions';

    protected $fillable = [
        'email',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'newsletter_subscriptions.email'     => 10,
        ]
    ];

    public function searchSubscription($term)
    {
        return self::search($term, null, true, true);
    }
}
