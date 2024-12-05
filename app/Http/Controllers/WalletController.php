<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        try {
            // Mengambil semua data wallet beserta user terkait
            $wallets = Wallet::with('user')->get();

            return response()->json([
                
                'wallets' => $wallets,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'Balance' => 'required|numeric|min:0',
            ]);

            $wallet = Wallet::create($request->all());
            return response()->json($wallet, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            return response()->json($wallet, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Wallet not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $wallet->update($request->all());
            return response()->json($wallet, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $wallet = Wallet::findOrFail($id);
            $wallet->delete();
            return response()->json(['message' => 'Wallet deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
