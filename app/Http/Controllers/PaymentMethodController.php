<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        try {
            $paymentMethods = PaymentMethod::all();
            return response()->json($paymentMethods, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'method_name' => 'required|string|max:100',
                'details' => 'nullable|string',
            ]);

            $paymentMethod = PaymentMethod::create($request->all());
            return response()->json($paymentMethod, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $paymentMethod = PaymentMethod::findOrFail($id);
            return response()->json($paymentMethod, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment method not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $paymentMethod = PaymentMethod::findOrFail($id);
            $request->validate([
                'method_name' => 'sometimes|string|max:100',
                'details' => 'nullable|string',
            ]);

            $paymentMethod->update($request->all());
            return response()->json($paymentMethod, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $paymentMethod = PaymentMethod::findOrFail($id);
            $paymentMethod->delete();
            return response()->json(['message' => 'Payment method deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
