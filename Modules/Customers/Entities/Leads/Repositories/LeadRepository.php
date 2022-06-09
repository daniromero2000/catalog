<?php

namespace Modules\Customers\Entities\Leads\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Modules\Customers\Entities\Leads\Exceptions\CreateLeadErrorException;
use Modules\Customers\Entities\Leads\Exceptions\DeletingLeadErrorException;
use Modules\Customers\Entities\Leads\Exceptions\LeadNotFoundException;
use Modules\Customers\Entities\Leads\Exceptions\UpdateLeadErrorException;
use Modules\Customers\Entities\Leads\Lead;
use Modules\Customers\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Customers\Mail\Leads\Admin\SendNewLeadEmailNotificationAdmin;
use Modules\Customers\Mail\Leads\Front\SendNewLeadEmailNotificationCustomer;

class LeadRepository implements LeadRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'last_name',
        'email',
        'phone',
        'city_id',
        'customer_channel_id',
        'lead_status_id',
        'lead_reason_id',
        'subsidiary_id',
        'service_id',
        'created_at'
    ];

    public function __construct(lead $lead)
    {
        $this->model = $lead;
    }

    public function createlead($data): Lead
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateLeadErrorException($e->getMessage());
        }
    }

    public function listLeads()
    {
        return  $this->model->with([
            'leadChannel',
            'leadStatus',
            'city',
            'service',
            'subsidiary'
        ])->select($this->columns)
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function listSubsidiaryLeads($subsidiary_id)
    {
        return  $this->model
            ->with([
                'leadChannel',
                'leadStatus',
                'city',
                'service',
                'subsidiary'
            ])
            ->where('subsidiary_id', $subsidiary_id)
            ->orderby('created_at', 'desc')
            ->paginate(10);
    }

    public function findLeadById(int $id): Lead
    {
        try {
            return $this->model->with([
                'leadChannel', 'leadStatus',
                'commentaries',
                'leadStatusesLogs',
                'city',
                'service',
                'subsidiary'
            ])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new LeadNotFoundException($e->getMessage());
        }
    }

    public function updateLead(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateLeadErrorException($e->getMessage());
        }
    }

    public function deleteLead(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingLeadErrorException($e->getMessage());
        }
    }

    public function searchLead(string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listLeads();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchLead($text)
                ->orderby('created_at', 'desc')
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchLead($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderby('created_at', 'desc')
            ->select($this->columns)
            ->paginate(10);
    }


    public function searchSubsidiaryLead(string $text = null, int $subsidiary_id, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listSubsidiaryLeads($subsidiary_id);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchLead($text)
                ->where('subsidiary_id', $subsidiary_id)
                ->orderby('created_at', 'desc')->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model
                ->where('subsidiary_id', $subsidiary_id)
                ->whereBetween('created_at', [$from, $to])
                ->orderby('created_at', 'desc')
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchLead($text)
            ->where('subsidiary_id', $subsidiary_id)
            ->whereBetween('created_at', [$from, $to])
            ->orderby('created_at', 'desc')->select($this->columns)
            ->paginate(10);
    }



    public function countLead(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchLead($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchLead($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function sendNewLeadRegisterToCostumer()
    {
        $lead = $this->findLeadById($this->model->id);

        Mail::to(['email' => $lead->email,])
            ->send(new SendNewLeadEmailNotificationCustomer($lead));
    }

    public function sendNewLeadRegisterToAdmin()
    {
        $lead = $this->findLeadById($this->model->id);

        Mail::to(['email' =>'ingreso.lefemme@gmail.com', 'community1.syc@gmail.com'])
            ->send(new SendNewLeadEmailNotificationAdmin($lead));
    }
}
