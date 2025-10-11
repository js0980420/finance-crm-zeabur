<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackingRecord;

class TrackingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = TrackingRecord::all();
        return response()->json(['data' => $records]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = TrackingRecord::create($request->all());
        return response()->json(['data' => $record, 'message' => 'Tracking record created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrackingRecord $trackingRecord)
    {
        return response()->json(['data' => $trackingRecord]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrackingRecord $trackingRecord)
    {
        $trackingRecord->update($request->all());
        return response()->json(['data' => $trackingRecord, 'message' => 'Tracking record updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrackingRecord $trackingRecord)
    {
        $trackingRecord->delete();
        return response()->json(['message' => 'Tracking record deleted successfully'], 204);
    }
}