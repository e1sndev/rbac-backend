<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Tenant::class);

        $params = $request->validate([
            'search' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
        ]) + [
            'search' => '',
            'page' => 1,
            'limit' => 10
        ];

        $result = Tenant::where('id', 'like', "%{$params['search']}%")
            ->paginate($params['limit']);

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Tenant::class);

        $data = $request->validate([
            'id' => 'required|alpha_dash|max:255|unique:tenants|min:3',
        ]);

        $tenant = Tenant::create($data);

        return response()->json($tenant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        Gate::authorize('delete', $tenant);

        $tenant->delete();

        return response()->json([
            'message' => 'Tenant deleted successfully'
        ]);
    }
}
