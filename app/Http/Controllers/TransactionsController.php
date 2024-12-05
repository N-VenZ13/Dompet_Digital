<?php

namespace App\Http\Controllers;

// use App\Models\Transaction;
use App\Models\Transactions;
// use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index()
    {
        try {
            $data = [];
            $transactions = Transactions::all();
            foreach ($transactions as $transaction) {
                $data[] = [
                    'id' => $transaction->id,
                    'wallets' => $transaction->wallets,
                    'amount' => $transaction->amount,
                    'type' => $transaction->type,
                    'description' => $transaction->description
                    
                ];
        } 
        return response()->json([
            'data' => $data
        ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'wallet_id' => 'required|exists:wallets,id',
                'amount' => 'required|numeric',
                'type' => 'required|in:credit,debit',
                'description' => 'nullable|string',
            ]);

            $transaction = Transactions::create($request->all());
            return response()->json($transaction, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $transaction = Transactions::findOrFail($id);
            return response()->json($transaction, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $transaction = Transactions::findOrFail($id);
            $transaction->update($request->all());
            return response()->json($transaction, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $transaction = Transactions::findOrFail($id);
            $transaction->delete();
            return response()->json(['message' => 'Transaction deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
