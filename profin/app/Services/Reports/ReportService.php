<?php
namespace App\Services\Reports;

use App\Models\Transaction;

class ReportService {

    private $instance;

    public function getTransaction() {
        $this->instance = Transaction::query();
        return $this;
    }

    public function user($userId) {
        $this->instance = $this->instance->where('user_id', $userId);
        return $this;
    }

    public function beforeCreatedAt($createdDate) {
        $this->instance = $this->instance->where('created_at', '<', $createdDate);
        return $this;
    }

    public function drCr($type) {
        $this->instance = $this->instance->where('dr_cr', $type);
        return $this;
    }

    public function currency($currencyId) {
        $this->instance = $this->instance->where('currency_id', $currencyId);
        return $this;
    }

    public function type($type) {
        $this->instance = $this->instance->where('type', $type);
        return $this;
    }

    public function status($status) {
        $this->instance = $this->instance->where('status', $status);
        return $this;
    }
    
    public function sumAmount($key) {
        return $this->instance->sum($key);
    }

    public function first() {
        $this->instance = $this->instance->first();
    }

    public function get() {
        $this->instance = $this->instance->get();
    }

}