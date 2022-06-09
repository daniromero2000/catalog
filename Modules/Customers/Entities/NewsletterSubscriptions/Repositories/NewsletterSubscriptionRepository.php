<?php

namespace Modules\Customers\Entities\NewsletterSubscriptions\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Customers\Entities\NewsletterSubscriptions\NewsletterSubscription;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces\NewsletterSubscriptionRepositoryInterface;

class NewsletterSubscriptionRepository implements NewsletterSubscriptionRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'email',
        'is_active',
        'created_at'
    ];

    public function __construct(NewsletterSubscription $newsletterSubscription)
    {
        $this->model = $newsletterSubscription;
    }

    public function listNewsletterSubscriptions($totalView): Support
    {
        return  $this->model->orderBy('created_at', 'asc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function createNewsletterSubscription(array $data): NewsletterSubscription
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteNewsletterSubscription(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchSubscription(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchSubscription($text)->get($this->columns);
    }
}
