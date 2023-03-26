<?php declare(strict_types=1);
namespace Stack83\StatamicChatGPT\Http\Controllers;

use Illuminate\Http\Request;
use Stack83\StatamicChatGPT\Services\Contracts\ChatService;
use Statamic\Http\Controllers\Controller;

final class ChatController extends Controller
{
    public function complete(Request $request, ChatService $chatService): \Illuminate\Http\JsonResponse
    {
        $response = $chatService->getCompletion($request->input('in'));

        return response()->json([
            'message' => $response
        ]);
    }
}
