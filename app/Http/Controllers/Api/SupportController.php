<?php

namespace App\Http\Controllers\Api;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupportController extends Controller
{

    /**
     * Inject Dependency SupportService
     * @param SupportService $service
     */
    public function __construct(protected SupportService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $support = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request->filter
        );

        return SupportResource::collection($support->items())
                                ->additional([
                                    'meta' => [
                                        'total' => $support->total(),
                                        'is_first_page' => $support->isFirstPage(),
                                        'is_last_page' => $support->isLastPage(),
                                        'current_page' => $support->currentPage(),
                                        'next_page' => $support->getNumberNextPage(),
                                        'previous_page' => $support->getNumberPreviousPage()
                                    ],
                                ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupport $request)
    {
        $support = $this->service->create(CreateSupportDTO::createFromRequest($request));

        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!$support = $this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupport $request, string $id)
    {
        $support = $this->service->update(UpdateSupportDTO::updateFromRequest($request, $id));

        if(!$support) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!$this->service->findOne($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
