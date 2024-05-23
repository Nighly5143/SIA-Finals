<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function view()
    {
        $foods = Food::orderBy('id')->get();
        return view('food.index', ['foods' => $foods]);
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'imageUrl' => 'required'
        ]);

        Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'imageUrl' => $request->imageUrl
        ]);

        return redirect('/food')->with('info', 'A new food item has been added.');
    }

    public function edit(Food $food)
    {
        return view('food.edit', compact('food'));
    }

    public function update(Food $food, Request $request)
    {
        $request->validate([
            'name' => 'nullable',
            'description' => 'required',
            'price' => 'required|numeric',
            'imageUrl' => 'required'
        ]);

        $food->update($request->all());
        return redirect('/food')->with('info', "Food item with ID# $food->id has been updated.");
    }

    public function generateCSV()
    {
        $foods = Food::orderBy('id')->get();
        $filename = '../storage/foods.csv';
        $file = fopen($filename, 'w+');

        foreach ($foods as $food) {
            fputcsv($file, [
                $food->name,
                $food->description,
                $food->price,
                $food->imageUrl
            ]);
        }
        fclose($file);

        return response()->download($filename);
    }

    public function delete(Food $food)
    {
        $food->delete();
        return redirect('/food')->with('info', "Food item with ID# $food->id has been deleted successfully.");
    }

    public function destroy($id)
    {
        // Example implementation: find the food item and show a confirmation view
        $food = Food::find($id);
        return view('food.confirm_delete', compact('food'));
    }

    public function pdf()
    {
        $foods = Food::orderBy('id')->get();
        $pdf = Pdf::loadView('food.pdf', compact('foods'));
        return $pdf->download('food.pdf');
    }

    public function importCSV(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048'
            ]);

            $file = $request->file('csv_file');
            $csvData = file_get_contents($file);
            $rows = array_map('str_getcsv', explode("\n", $csvData));

            foreach ($rows as $row) {
                if (empty(array_filter($row))) {
                    continue;
                }
    
                $data = [
                    'name' => $row[0] ?? null,
                    'description' => $row[1] ?? null,
                    'price' => $row[2] ?? null,
                    'imageUrl' => $row[3] ?? null
                ];

                $validator = Validator::make([
                    'name' => $row[0] ?? null,
                    'description' => $row[1] ?? null,
                    'price' => $row[2] ?? null,
                    'imageUrl' => $row[3] ?? null
                ], [
                    'name' => 'required',
                    'description' => 'required',
                    'price' => 'required|numeric',
                    'imageUrl' => 'required'
                ]);

                if ($validator->fails()) {
                    continue;
                }

                $existingFood = Food::where('name', $data['name'])->first();
                if ($existingFood) {
                    continue;
                }

                Food::create([
                    'name' => $row[0],
                    'description' => $row[1],
                    'price' => $row[2],
                    'imageUrl' => $row[3]
                ]);
            }

            return redirect('/food')->with('info', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
