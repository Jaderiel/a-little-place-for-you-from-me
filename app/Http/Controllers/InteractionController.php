<?php

namespace App\Http\Controllers;

use App\Models\LoreFact;
use App\Models\SupportMessage;
use App\Models\TriviaQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function randomLore(): JsonResponse
    {
        $fact = LoreFact::inRandomOrder()->first();

        return response()->json([
            'label' => $fact?->label,
            'value' => $fact?->value ?? 'The lore archive is empty for now.',
        ]);
    }

    public function randomSupportMessage(): JsonResponse
    {
        return response()->json([
            'message' => SupportMessage::inRandomOrder()->value('message')
                ?? 'Whatever today was, you got through it. That counts.',
        ]);
    }

    /**
     * Answers are graded server-side so the correct options never ship to the browser.
     */
    public function checkAnswer(Request $request): JsonResponse
    {
        $data = $request->validate([
            'question_id' => ['required', 'integer', 'exists:trivia_questions,id'],
            'answer' => ['required', 'integer', 'min:0'],
        ]);

        $question = TriviaQuestion::findOrFail($data['question_id']);

        return response()->json([
            'correct' => $question->correct_index === $data['answer'],
            'correct_index' => $question->correct_index,
            'response' => $question->response,
        ]);
    }
}
