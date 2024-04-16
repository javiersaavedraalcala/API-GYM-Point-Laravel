<?php

namespace App\Http\Controllers;

use App\Events\SubscriptionEvent;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ClientCollection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $client =  DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $validated['uid'] = uniqid();
            $client = new Client($validated);
            $client->save();

            event(new SubscriptionEvent($client, $request['plan']));

            return $client;
        });

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->validated();
        $client->update($validated);

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->noContent();
    }
}
