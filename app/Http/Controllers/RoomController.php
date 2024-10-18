<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Repositories\Room\RoomRepository;
use App\Traits\UploadHendler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    use UploadHendler;
    protected $repositoryRoom;
    public function __construct(RoomRepository $repositoryRoom)
    {
        $this->repositoryRoom = $repositoryRoom;
    }

    public function index(): JsonResponse{
        $rooms = $this->repositoryRoom->all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data kamar berhasil diambil.',
            'data' => RoomResource::collection($rooms)
        ]);
    }
    public function store(RoomRequest $request): JsonResponse{
        $image = $this->uploadImageHelper($request->images,'room/image');
        $room = $this->repositoryRoom->create([
            'name' => $request->name,
            'description' => $request->description,
            'feature' => $request->feature,
            'published' => $request->published,
            'availability' => $request->availability,
            'images' => $image,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data kamar berhasil ditambahkan.',
            'data' => new RoomResource($room)
        ]);
    }

    public function edit(Request $request, $id): JsonResponse
    {

        $image = null;
        if ($request->hasFile('images')) {
            $image = $this->uploadImageHelper($request->file('images'), 'room/image');
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'feature' => $request->feature,
            'published' => $request->published,
            'availability' => $request->availability,
        ];

        if ($image) {
            $data['images'] = $image;
        }

        // Check if the room exists
        $room = $this->repositoryRoom->find($id);

        if (!$room) {
            return response()->json([
                'status' => 'error',
                'message' => 'Room not found.',
                'data' => []
            ], 404);
        }

        // Proceed with the update
        $room = $this->repositoryRoom->updates($room->id, $data);
        return response()->json([
            'status' => 'success',
            'message' => 'Data kamar berhasil diperbarui.',
            'data' => new RoomResource($room)
        ]);
    }

    public function delete($id): JsonResponse{
        $data = $this->repositoryRoom->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data kamar berhasil Di Delete.',
            'data' => $data
        ]);
    }

}
