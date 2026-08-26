<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        public function index()
        {
            $categories = Category::all();

            return view('categories.index', compact('categories'));
        }

        public function create()
        {
            return view('categories.create');
        }

        public function store(StoreCategoryRequest $request)
        {
            $data = $request->validated();

            $data['slug'] = Str::slug($data['name']);

            Category::create($data);

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil ditambahkan.');
        }

        public function edit(Category $category)
        {
            return view('categories.edit', compact('category'));
        }

        public function update(UpdateCategoryRequest $request, Category $category)
        {
            $data = $request->validated();

            $data['slug'] = Str::slug($data['name']);

            $category->update($data);

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil diperbarui.');
        }
        public function destroy(Category $category)
        {
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil dihapus.');
        }
}