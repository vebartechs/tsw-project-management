<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create($id = null)
    {
        $customer = Customer::find($id) ?? new Customer();
        return view('customers.create', compact('customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'address' => 'nullable',
        ]);

        $customer = Customer::updateOrCreate(['id' => $request->id], $request->all());

        return redirect()->route('customer.index')->with('success', 'Customer added successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }


    // Ajax customers
    public function searchCustomer(Request $request)
    {
        $term = $request->get('term', '');
        $customers = Customer::where('name', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get(['id', 'name', 'phone', 'email', 'address']);

        $result = [];
        foreach ($customers as $customer) {
            $result[] = [
                'id' => $customer->id,
                'label' => $customer->name . ' -- ' . $customer->phone.' -- ' . $customer->address,
                'value' => $customer->name.' - Phone: '.$customer->phone,
            ];
        }

        return response()->json($result);
    }


}
