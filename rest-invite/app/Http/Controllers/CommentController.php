<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')->get();
        return response()->json($comments);
    }


    public function getCommentsByUser($id)
    {
        // Mendapatkan semua komentar dari user_id tertentu
        $comments = Comment::where('user_id', $id)->get();

        // Mengembalikan response JSON dengan komentar-komentar tersebut
        return response()->json($comments);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        Log::info('Data received in store method:', $data);

        // Periksa apakah data adalah array tetapi bukan array dari array
        if (is_array($data) && !array_key_exists(0, $data)) {
            return $this->storeSingle($data);
        }

        // Jika data adalah array dari objek, maka handle array
        return $this->storeMultiple($data);
    }

    private function storeSingle($data)
    {
        Log::info('Data received in storeSingle method:', $data);
        // Validasi data
        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'commenter_name' => 'required|string|max:255',
            'content' => 'required|string',
            'kehadiran' => 'required|in:Hadir,Tidak Hadir,Belum Tau',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Buat komentar baru
        $comment = Comment::create($validator->validated());

        // Kembalikan response JSON dengan komentar yang baru dibuat
        return response()->json($comment, 201);
    }

    private function storeMultiple(array $data)
    {
        $validatedComments = [];

        // Validasi setiap item dalam array
        foreach ($data as $commentData) {
            $validator = Validator::make($commentData, [
                'user_id' => 'required|exists:users,id',
                'commenter_name' => 'required|string|max:255',
                'content' => 'required|string',
                'kehadiran' => 'required|in:Hadir,Tidak Hadir,Belum Tau',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            $validatedComments[] = $validator->validated();
        }

        // Gunakan transaksi database
        DB::beginTransaction();

        try {
            $comments = [];
            foreach ($validatedComments as $validatedData) {
                $comments[] = Comment::create($validatedData);
            }

            DB::commit();

            return response()->json($comments, 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to create comments', 'message' => $e->getMessage()], 500);
        }
    }

    public function show(Comment $comment)
    {
        $comment->load('user'); 
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'commenter_name' => 'required',
            'content' => 'required',
            'kehadiran' => 'required|in:hadir,belum tahu,tidak hadir', 
        ]);

        $comment->update($request->all());

        return response()->json($comment, 200);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(null, 204);
    }
}

