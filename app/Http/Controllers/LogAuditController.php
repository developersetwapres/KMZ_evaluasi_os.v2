<?php

namespace App\Http\Controllers;

use App\Models\log_audit;
use App\Http\Requests\Storelog_auditRequest;
use App\Http\Requests\Updatelog_auditRequest;

class LogAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storelog_auditRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(log_audit $log_audit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(log_audit $log_audit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatelog_auditRequest $request, log_audit $log_audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(log_audit $log_audit)
    {
        //
    }
}
